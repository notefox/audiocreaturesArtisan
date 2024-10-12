<?php

    namespace App\Livewire;

    use App\Livewire\Forms\PublisherForm;
    use Illuminate\Support\Facades\Redirect;
    use Livewire\WithFileUploads;
    use LivewireUI\Modal\ModalComponent;

    class CreatePublisher extends ModalComponent {

        use WithFileUploads;

        public PublisherForm $form;

        public function save(): null {
            $this->form->store();

            $this->redirect('dashboard');
            return null;
        }

        /** @noinspection PhpMissingReturnTypeInspection */
        public function render() {
            return view('livewire.form-publisher');
        }
    }
