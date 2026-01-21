<?php

namespace App\Livewire;

use App\Models\Images;
use Livewire\Component;

class ProjectImagePicker extends Component
{
    /**
     * IDs of images currently selected in the parent form
     * @var array<int,int>
     */
    public array $selectedIds = [];

    /**
     * Fully qualified Livewire component name to emit selection events to
     */
    public string $emitTo = 'App\\Livewire\\CreateProject';

    /**
     * Computed property: fetch selected Images models for preview
     */
    public function getImagesProperty()
    {
        $ids = $this->selectedIds ?? [];
        if (empty($ids)) {
            return collect();
        }

        return Images::query()->whereIn('id', $ids)->get();
    }

    /**
     * Clear selection by emitting an imagesSelected event with an empty array to the parent target
     */
    public function clear(): void
    {
        $this->dispatch('imagesSelected', [])->to($this->emitTo);
    }

    public function render()
    {
        return view('livewire.project-image-picker');
    }
}
