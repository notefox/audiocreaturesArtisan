<?php

    namespace App\Livewire;

    use App\Livewire\Forms\GenreForm;
    use LivewireUI\Modal\ModalComponent;

    class CreateGenre extends ModalComponent {

        public GenreForm $form;

        public function save(): void {
            $this->form->store();

            $this->closeModal();
        }

        public function render() {
            return view('livewire.form-genre');
        }

    }
