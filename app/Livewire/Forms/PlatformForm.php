<?php

	namespace App\Livewire\Forms;

	use App\Models\Platform;
    use Livewire\Attributes\Validate;
    use Livewire\Form;

    class PlatformForm extends Form {
        public ?Platform $project_type;

        #[Validate('required|min:3')]
        public string $name = '';

        public function load(Platform $project_type): void {
            $this->name = $project_type->name;
        }

        public function update(): void {
            $this->validate();

            $this->project_type->update( $this->getAttributes() );
        }

        public function store(): void {
            $this->validate();

            $this->name = $this->getPropertyValue('name');

            $this->project_type = Platform::factory()->create($this->getAttributes());

            $this->reset();
        }

        private function getAttributes(): array {
            return $this->only(['name']);
        }
	}
