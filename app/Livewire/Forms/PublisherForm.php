<?php

    namespace App\Livewire\Forms;

    use App\Models\Publisher;
    use App\Repositories\ImageRepository;
    use Illuminate\Support\Carbon;
    use Livewire\Attributes\Validate;
    use Livewire\Form;

    class PublisherForm extends Form {
        // mounting publisher if it's getting updated
        public ?Publisher $publisher;

        #[Validate('required|min:3')]
        public $name = '';
        #[Validate('required')]
        public $country = '';
        #[Validate('required|url')]
        public $link = '';
        #[Validate('required|file|max:102400')]
        public $logo = '';

        public $logo_id = null;
        public $created_at = null;
        public $updated_at = null;

        public function load(Publisher $publisher): void {
            $this->publisher = $publisher;

            $this->name = $publisher->name;
            $this->country = $publisher->country;
            $this->link = $publisher->link;
            $this->logo = $publisher->logo;
        }

        public function update(): void {
            $this->validate();

            $this->updated_at = Carbon::now();

            $this->update_image($this->logo);

            $this->publisher->update($this->getAttributes());
        }

        public function store(): void {
            $this->validate();

            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();

            $saved_image = ImageRepository::uploadImage($this->getPropertyValue('logo'));

            $this->logo_id = $saved_image->id;

            $this->publisher = Publisher::factory()->create($this->getAttributes());

            $this->reset();
        }

        private function getAttributes(): array {
            return $this->only(['name', 'country', 'link', 'logo_id']);
        }

        private function update_image(mixed $logo) {

        }

    }
