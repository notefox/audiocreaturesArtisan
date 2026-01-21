<?php

	namespace Tests\Feature\Livewire\ImageUpload;

	use Tests\TestCase;
    use Livewire\Livewire;
    use Illuminate\Http\UploadedFile;
    use Illuminate\Foundation\Testing\RefreshDatabase;
    use App\Livewire\CreateImages;
    use App\Models\Images;
    use Mockery;

    /**
     * Livewire tests for the image upload form/component
     */
	class UploadPhotoTest extends TestCase {

        use RefreshDatabase;

        protected function tearDown(): void
        {
            Mockery::close();
            parent::tearDown();
        }

        public function test_user_can_upload_image_and_get_redirected()
        {
            // Arrange: mock the repository static call so we don't touch storage/Intervention
            $fakeImage = Images::factory()->create();

            Mockery::mock('alias:App\\Repositories\\ImageRepository')
                ->shouldReceive('uploadImage')
                ->once()
                ->andReturn($fakeImage);

            $file = UploadedFile::fake()->image('cover.jpg', 600, 600);

            // Act + Assert
            Livewire::test(CreateImages::class)
                ->set('form.name', 'My Cover')
                ->set('form.imageReference', $file)
                ->call('save')
                ->assertRedirect('dashboard');
        }

        public function test_validation_fails_when_name_is_missing()
        {
            $file = UploadedFile::fake()->image('cover.jpg');

            Livewire::test(CreateImages::class)
                ->set('form.imageReference', $file)
                ->call('save')
                ->assertHasErrors(['form.name' => 'required']);
        }
	}
