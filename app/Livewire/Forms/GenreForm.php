<?php

    namespace App\Livewire\Forms;

    use App\Models\Genre;
    use Illuminate\Support\Carbon;
    use Livewire\Form;

    class GenreForm extends Form {
        public ?Genre $genre;

        public $name = '';

        public $created_at = null;
        public $updated_at = null;

        public function load(Genre $genre): void {
            $this->genre = $genre;

            $this->name = $genre->name;
        }

        public function update(): void {
            $this->validate();

            $this->updated_at = Carbon::now();

            $this->genre->update($this->only(['name', 'updated_at']));
        }

        public function store(): void {
            $this->validate();

            $this->created_at = Carbon::now();
            $this->updated_at = Carbon::now();

            Genre::create($this->only(['name', 'created_at', 'updated_at']));

            $this->reset();
        }

    }
