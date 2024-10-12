<?php

	namespace App\Livewire;

	use App\Livewire\Forms\PlatformForm;
    use LivewireUI\Modal\ModalComponent;

    class CreatePlatform extends ModalComponent {
        public PlatformForm $form;

        public function save() {
            $this->form->store();

            $this->redirect('dashboard');
            return null;
        }

        public function render() {
            return view('livewire.form-platform');
        }
	}
