<?php

    namespace App\Repositories;

    use App\Models\Images;

    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\Database\Eloquent\Model;
    use Illuminate\Support\Facades\Storage;

    use Intervention\Image\Laravel\Facades\Image;

    /**
     * Class ImageRepository.
     */
    class ImageRepository {

        public static array $alt_sizes = [
            "thumbnail"    => [ 300, 300 ],
            "medium"       => [ 600, 600 ],
            "medium_large" => [ 768, null ],
            "large"        => [ 1200, 800 ],
        ];

        public static function getImage($name): Images {
            return Images::all()->firstWhere( 'image_name', '=', $name);
        }

        public static function uploadImage( $image, $name = "", $with_alt = true ): Images {
            $uploaded = self::upload( $image, $name );

            if ( $with_alt ) {
                collect( self::$alt_sizes )
                    ->each( fn( $size, $size_name ) => self::createAltImageSizes( $uploaded, $size_name, ...$size ) );
            }

            return $uploaded;
        }

        private static function upload( $image, $name = "" ): Images {
            $name = $name ?: uniqid();
            $path = Storage::disk( 'public' )->put( 'images', $image );

            $absolute_path = Storage::disk( 'public' )->path( $path );

            return self::addImageEntry( $absolute_path, $name, $path );
        }

        private static function createAltImageSizes( Images $parent_image, string $name, int $width, int|null $height ): void {
            $image_path = Storage::disk( 'public' )->path( $parent_image->image_path );
            $image_sizes_path = Storage::disk( 'sizes' );

            $image = Image::read( $image_path );

            $image->scale( $width, $height );

            $downscaled_image_name = "{$parent_image->image_name}-$name";
            $absolute_path = $image_sizes_path->path( $downscaled_image_name . ".webp" );

            // save in tmp
            $image->toWebp()->save( $absolute_path );

            // calculate relative path
            $relative_path = str_replace( storage_path( 'app/' ), '', $absolute_path );

            self::addImageEntry( $absolute_path, $downscaled_image_name, $relative_path, $parent_image->id );
        }

        /**
         * @param string $absolute_path
         * @param mixed $name
         * @param string $path
         * @param int $parent
         *
         * @return Images|Collection|Model
         */
        private static function addImageEntry( string $absolute_path, mixed $name, string $path, int $parent = 0 ): Images|Collection|Model {
            $checksum = calculate_sha256_of_file( $absolute_path );

            $mime_type = mime_content_type( $absolute_path );

            return Images::factory()->create( [
                                                  'image_name' => $name,
                                                  'image_path' => $path,
                                                  'sha256'     => $checksum,
                                                  'mime_type'  => $mime_type,
                                                  'parent'     => $parent,
                                              ] );
        }
    }
