<?php

namespace Tests\Feature\Repositories;

use App\Models\Images;
use App\Repositories\ImageRepository;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Mockery;
use Tests\TestCase;

class ImageRepositoryTest extends TestCase
{
    use RefreshDatabase;

    protected function tearDown(): void
    {
        Mockery::close();
        parent::tearDown();
    }

    public function test_upload_image_sets_id_and_creates_subsizes()
    {
        // Fake storage for both disks used by the repository
        Storage::fake('public');
        Storage::fake('sizes');

        // Mock Intervention Image chain so no real image processing happens
        $imageMock = Mockery::mock();
        $imageMock->shouldReceive('scale')->withAnyArgs()->andReturnSelf();
        $imageMock->shouldReceive('toWebp')->andReturnSelf();

        $imageMock->shouldReceive('save')->withAnyArgs()->andReturnUsing(function ($path) {
            // Ensure a file exists at the target path to satisfy mime/hash functions
            @mkdir(dirname($path), 0777, true);
            file_put_contents($path, 'fake-webp-binary');
            return true;
        });

        Mockery::mock('alias:Intervention\\Image\\Laravel\\Facades\\Image')
            ->shouldReceive('read')
            ->andReturn($imageMock);

        // Use a real fake image upload
        $upload = UploadedFile::fake()->image('photo.jpg', 800, 800);

        // Act
        $uploaded = ImageRepository::uploadImage($upload, 'my_test_image', true);

        // Assert: ID is set on the created image
        $this->assertInstanceOf(Images::class, $uploaded);
        $this->assertIsInt($uploaded->id);
        $this->assertGreaterThan(0, $uploaded->id);

        // Assert: subsizes were created as children of the original
        $expectedSizes = array_keys(ImageRepository::$alt_sizes);

        // Collect children directly from the model helpers
        $children = Images::all()->where('parent', '=', $uploaded->id);
        $this->assertCount(count($expectedSizes), $children, 'Expected one child per defined alt size');

        foreach ($expectedSizes as $sizeName) {
            $child = Images::all()
                ->where('parent', '=', $uploaded->id)
                ->firstWhere('image_name', '=', "{$uploaded->image_name}-$sizeName");

            $this->assertNotNull($child, "Missing generated size: $sizeName");
            $this->assertSame($uploaded->id, $child->parent, 'Child parent id mismatch');

            // Model helpers sanity checks
            $this->assertSame($uploaded->id, $child->original()->id);
            $this->assertTrue($uploaded->isOriginal());
        }
    }
}
