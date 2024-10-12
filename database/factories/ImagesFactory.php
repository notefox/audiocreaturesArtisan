<?php

    namespace Database\Factories;

    use App\Models\Images;
    use Illuminate\Database\Eloquent\Factories\Factory;

    class ImagesFactory extends Factory {
        protected $model = Images::class;

        public function definition(): array {
            return [
                'image_name' => fake()->name,
                'image_path' => fake()->filePath(),
                'sha256' => fake()->sha256,
                'mime_type' => fake()->mimeType(),
            ];
        }
    }
