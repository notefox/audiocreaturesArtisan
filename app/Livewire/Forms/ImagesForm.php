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

        #[Validate('required|image|max:10240')]
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
            // For updates, only name is required; image file replacement is optional
            $this->validate([
                'name' => 'required|min:3',
                'imageReference' => 'nullable|image|max:10240',
            ]);

            if (!($this->image && $this->image->id)) {
                // No existing image bound — fallback to create
                $this->store();
                return;
            }

            $original = $this->image;
            $oldName  = (string) ($original->image_name ?? '');
            $newName  = (string) $this->getPropertyValue('name');

            // If the name changed, update parent and children names
            if ($newName !== '' && $newName !== $oldName) {
                // Update parent name
                $original->image_name = $newName;
                $original->save();

                // Update children names by replacing the prefix `${oldName}-` with `${newName}-`
                $children = \App\Models\Images::all()->where('parent', '=', $original->id);
                foreach ($children as $child) {
                    $childName = (string) ($child->image_name ?? '');
                    if ($oldName !== '' && str_starts_with($childName, $oldName . '-')) {
                        $child->image_name = $newName . '-' . substr($childName, strlen($oldName) + 1);
                        $child->save();
                    }
                }
            }

            // Note: Replacing the physical image file via imageReference is not implemented here
            // to keep changes minimal. This function focuses on updating metadata (name).

            // Keep the bound image up-to-date
            $this->image = $original;
        }

        public function setImage( Images $image ): void {

            $this->image = $image;

            $this->name = $image->image_name ?? '';

            // Do not set imageReference to a persisted path string; it should be a TemporaryUploadedFile.
            // Leaving it null avoids preview issues in edit mode.
            $this->imageReference = null;

        }

    }
