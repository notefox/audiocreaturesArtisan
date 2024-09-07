<?php

    namespace App\Livewire;

    use Illuminate\Database\Eloquent\Collection;
    use Illuminate\View\View;
    use Livewire\Attributes\On;
    use Livewire\Component;

    class ListDatatypeEntries extends Component {
        public string $datatype = '';
        public Collection $entries;

        public function mount($datatype, $entries): void {
            $this->datatype = $datatype;
            $this->entries = $entries;
        }

        public function render(): View {
            return view('livewire.list-datatype-entries', ['id' => $this->datatype]);
        }
    }
