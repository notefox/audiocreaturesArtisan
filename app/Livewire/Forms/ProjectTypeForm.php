<?php

	namespace App\Livewire\Forms;

	use App\Models\ProjectType;
    use Illuminate\Support\Carbon;
    use Livewire\Form;

	class ProjectTypeForm extends Form {
        public ?ProjectType $project_type;

        public $name = '';

        public $created_at = null;
        public $updated_at = null;

        public function load(ProjectType $project_type): void {
            $this->project_type = $project_type;

            $this->name = $project_type->name;
        }

        public function update(): void {
            $this->validate();

            $this->updated_at = Carbon::now();

            $this->project_type->update($this->only(['name', 'updated_at']));
        }

        public function store(): void {
            $this->validate();

            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();

            ProjectType::create($this->only(['name', 'created_at', 'updated_at']));

            $this->reset();
        }

	}
