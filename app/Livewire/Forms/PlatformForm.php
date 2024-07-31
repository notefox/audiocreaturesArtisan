<?php

    namespace App\Livewire\Forms;

    use App\Models\Platform;
    use Illuminate\Support\Carbon;
    use Livewire\Form;

    class PlatformForm extends Form {
        public ?Platform $platform;

        public $name = '';

        public $created_at = null;
        public $updated_at = null;

        public function load(Platform $platform): void {
            $this->platform = $platform;

            $this->name = $platform->name;
        }

        public function update(): void {
            $this->validate();

            $this->updated_at = Carbon::now();

            $this->platform->update($this->only(['name', 'updated_at']));
        }

        public function store(): void {
            $this->validate();

            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();

            Platform::create($this->only(['name', 'created_at', 'updated_at']));

            $this->reset();
        }

    }
