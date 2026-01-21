<?php

namespace App\Livewire;

use App\Models\Images;
use Livewire\Attributes\Validate;
use LivewireUI\Modal\ModalComponent;

class SelectImage extends ModalComponent
{
    // Optional: limit selection to originals (parent = 0)
    public bool $originalOnly = true;

    // Simple search term
    public string $search = '';

    // Multiple selection support
    public bool $multiple = false;
    public array $selected = [];

    // Event dispatching configuration
    public ?string $emitTo = null; // Livewire component FQN/name to target, or null for global
    public string $event = 'imageSelected'; // Event name to dispatch with the selected id

    public function mount(?string $emitTo = null, string $event = 'imageSelected', bool $originalOnly = true, bool $multiple = false, array $preselected = []): void
    {
        $this->emitTo = $emitTo;
        $this->event = $event;
        $this->originalOnly = $originalOnly;
        $this->multiple = $multiple;
        // Initialize selected with unique integer IDs
        $this->selected = array_values(array_unique(array_map('intval', $preselected)));
    }

    public function select(int $id): void
    {
        if ($this->multiple) {
            // In multiple mode, toggle selection instead of immediately emitting
            $this->toggleSelect($id);
            return;
        }

        // Single select: emit the selection event to either a specific component or globally
        $this->emitSelection([$id]);
    }

    public function toggleSelect(int $id): void
    {
        if (!in_array($id, $this->selected, true)) {
            $this->selected[] = $id;
        } else {
            $this->selected = array_values(array_filter($this->selected, fn ($v) => $v !== $id));
        }
    }

    public function isSelected(int $id): bool
    {
        return in_array($id, $this->selected, true);
    }

    public function confirmSelection(): void
    {
        if (!$this->multiple) {
            return; // noop in single-select mode
        }

        $ids = array_values(array_unique(array_map('intval', $this->selected)));
        if (count($ids) === 0) {
            return; // nothing to do
        }

        $this->emitSelection($ids);
    }

    private function emitSelection(array $ids): void
    {
        if ($this->emitTo) {
            $this->closeModalWithEvents([
                $this->emitTo => [$this->event, [$this->multiple ? $ids : ($ids[0] ?? null)]],
            ]);
        } else {
            // Global event (no specific target)
            $this->closeModalWithEvents([
                [$this->event, [$this->multiple ? $ids : ($ids[0] ?? null)]],
            ]);
        }
    }

    public function getImagesProperty()
    {
        $query = Images::query();

        if ($this->originalOnly) {
            $query->where('parent', '=', 0);
        }

        if (trim($this->search) !== '') {
            $term = '%' . trim($this->search) . '%';
            $query->where('image_name', 'like', $term);
        }

        return $query->orderByDesc('id')->limit(30)->get();
    }

    public function render()
    {
        return view('livewire.select-image');
    }
}
