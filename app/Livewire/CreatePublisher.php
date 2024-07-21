<?php

    namespace App\Livewire;

    use App\Livewire\Forms\PublisherForm;
    use Livewire\WithFileUploads;
    use LivewireUI\Modal\ModalComponent;

    class CreatePublisher extends ModalComponent {

        use WithFileUploads;

        public PublisherForm $form;

        public function save() {
            $this->form->store();

            $this->redirect('dashboard');
        }

        /** @noinspection PhpMissingReturnTypeInspection */
        public function render() {
            return view('livewire.form-publisher');
        }
    }
