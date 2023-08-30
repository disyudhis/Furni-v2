<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Product extends Component
{
    public $title;

    public function openModal()
    {
        $this->dispatchBrowserEvent('openModal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('closeModal');
    }

    public function store()
    {
        $this->title = null;
        $this->closeModal();
    }

    public function render()
    {
        return view('livewire.admin.product')->extends('layouts.app')
            ->section('content');
    }
}