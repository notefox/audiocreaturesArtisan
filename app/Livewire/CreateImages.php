<?php

	namespace App\Livewire;

	use App\Livewire\Forms\ImagesForm;
    use App\Models\Images;
    use Livewire\WithFileUploads;
    use LivewireUI\Modal\ModalComponent;

 class CreateImages extends ModalComponent {

        use WithFileUploads;

        public ImagesForm $form;

        public function mount(Images $image) {
            $this->form->setImage($image);
        }

        public function save() {
            if ($this->form->image && $this->form->image->id) {
                $this->form->update();
            } else {
                $this->form->store();
            }

            $this->redirect('dashboard');
            return null;
        }

        public function render() {
            return view('livewire.form-images');
        }

	}
