<?php

    namespace App\Livewire\Forms;

    use App\Models\ReferenceLink;
    use App\Models\ReferenceLinkType;
    use Illuminate\Support\Carbon;
    use Livewire\Form;

    class LinkReferenceForm extends Form {
        public ?ReferenceLink $reference_link = null;

        public ?ReferenceLinkType $reference_link_type = null;

        public string $string = '';
        public ?int $reference_link_type_id = null;

        public $created_at = null;
        public $updated_at = null;
        function load(ReferenceLink $reference_link): void {
            $this->reference_link = $reference_link;

            $this->reference_link_type = $reference_link->getConnectedType();

            $this->string = $reference_link->string;
            $this->reference_link_type_id = $this->reference_link_type?->id;
        }

        public function update() {
            $this->validate();

            $this->updated_at = Carbon::now();

            $this->reference_link->update($this->only(['string', 'reference_link_type_id']));
        }

        public function store() {
            $this->validate();

            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();

            ReferenceLink::create(['string', 'reference_link_type_id']);
        }
    }
