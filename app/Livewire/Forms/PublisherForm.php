<?php

namespace App\Livewire\Forms;

use App\Models\Publisher;
use Illuminate\Support\Carbon;
use Livewire\Attributes\Validate;
use Livewire\Form;

class PublisherForm extends Form
{
    // mounting publisher if it's getting updated
    public ?Publisher $publisher;

    #[Validate('required|min:3')]
    public $name = '';
    #[Validate('required')]
    public $country = '';
    #[Validate('required|url')]
    public $link = '';
    #[Validate('required|file')]
    public $logo = '';

    public $created_at = null;

    public function load(Publisher $publisher): void {
        $this->publisher = $publisher;

        $this->name = $publisher->name;
        $this->country = $publisher->country;
        $this->link = $publisher->link;
        $this->logo = $publisher->logo;
    }

    public function update() {
        $this->validate();

        $this->publisher->update($this->all());
    }

    public function store(): void {
        $this->validate();

        $this->created_at = Carbon::now();

        Publisher::create($this->only(['name', 'country', 'link', 'logo', 'created_at']));

        $this->reset();
    }
}
