<?php

	namespace App\Livewire;

	use App\Models\Project;
    use Livewire\Component;

    class ListDatatypeEntries extends Component {
        public string $datatype = '';
        public $entries = [];

        public function mount($datatype, $entries) {
            $this->datatype = $datatype;
            $this->entries = $entries;
        }

        public function render() {
            return view('livewire.list-datatype-entries');
        }
	}
