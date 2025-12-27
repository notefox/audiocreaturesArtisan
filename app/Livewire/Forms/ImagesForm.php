<?php

	namespace App\Livewire\Forms;

	use App\Models\Images;
    use App\Repositories\ImageRepository;
    use Livewire\Attributes\Validate;
    use Livewire\Form;

    class ImagesForm extends Form {

        public ?Images $image;

        #[Validate('required|min:3')]
        public string $name = '';

        public $imageReference = null;

        public function store(): void {
            $this->validate();

            $uploaded_image = ImageRepository::uploadImage(
                $this->getPropertyValue('imageReference'), $this->getPropertyValue('name')
            );

            $this->image = $uploaded_image;

            $this->reset();
        }

        public function update(): void {
            $this->validate();

            // TODO: implement
        }

        public function setImage( Images $image ): void {

            $this->image = $image;

            $this->name = $image->image_name;

            $this->imageReference = $image->image_path;

        }

    }
