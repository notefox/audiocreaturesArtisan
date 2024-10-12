<?php

	namespace App\Livewire\Forms;

	use App\Models\Genre;
    use Livewire\Attributes\Validate;
    use Livewire\Form;

    class GenreForm extends Form {

        public ?Genre $genre;

        #[Validate('required|min:3')]
        public string $name = '';

        public function load(Genre $project_type): void {
            $this->name = $project_type->name;
        }

        public function update(): void {
            $this->validate();

            $this->project_type->update( $this->getAttributes() );
        }

        public function store(): void {
            $this->validate();

            $this->name = $this->getPropertyValue('name');

            $this->genre = Genre::factory()->create($this->getAttributes());

            $this->reset();
        }

        private function getAttributes(): array {
            return $this->only(['name']);
        }

	}
