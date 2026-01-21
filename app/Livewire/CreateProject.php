<?php

namespace App\Livewire;

use App\Livewire\Forms\ProjectForm;
use App\Models\Images;
use Livewire\Attributes\On;
use LivewireUI\Modal\ModalComponent;

class CreateProject extends ModalComponent
{
    public ProjectForm $form;

    public function mount(): void
    {
        // Default state is already handled by the ProjectForm properties
    }

    #[On('imageSelected')]
    public function imageSelected(int $id): void
    {
        $this->form->setSelectedImage($id);
    }

    #[On('imagesSelected')]
    public function imagesSelected($ids): void
    {
        // Support either a single id or an array from the modal
        if (!is_array($ids)) {
            $ids = [$ids];
        }
        $this->form->setSelectedImages($ids);
    }

    public function save(): void
    {
        $this->form->store();

        // After creating, redirect to dashboard (consistent with other flows)
        $this->redirect('dashboard');
    }

    public function clearSelection(): void
    {
        $this->form->setSelectedImages([]);
    }

    public function getSelectedImagesProperty()
    {
        $ids = $this->form->image_ids ?? [];
        if (empty($ids)) {
            return collect();
        }
        return Images::query()->whereIn('id', $ids)->get();
    }

    public function render()
    {
        return view('livewire.form-project');
    }
}
