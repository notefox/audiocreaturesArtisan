<?php

	namespace App\Livewire;

	use App\Livewire\Forms\ProjectTypeForm;
    use LivewireUI\Modal\ModalComponent;

    class CreateProjectType extends ModalComponent {
        public ProjectTypeForm $form;

        public function save(): null {
            $this->form->store();

            $this->closeModal();
            return null;
        }

        public function render() {
            return view('livewire.form-project-type');
        }
	}
