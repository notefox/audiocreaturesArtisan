<?php

	namespace App\Livewire\Forms;

	use App\Models\ProjectType;
    use Livewire\Attributes\Validate;
    use Livewire\Form;

    class ProjectTypeForm extends Form {

        public ?ProjectType $project_type;

        #[Validate('required|min:3')]
        public string $name = '';



        public function load(ProjectType $project_type): void {
            $this->name = $project_type->name;
        }

        public function update(): void {
            $this->validate();

            $this->project_type->update( $this->getAttributes() );
        }

        public function store(): void {
            $this->validate();

            $this->name = $this->getPropertyValue('name');

            $this->project_type = ProjectType::factory()->create($this->getAttributes());

            $this->reset();
        }

        private function getAttributes(): array {
            return $this->only(['name']);
        }
	}
