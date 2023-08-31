<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Category extends Component
{
    public $name;
    protected $rules = [
        'name' => 'required|min:1|unique:categories'
    ];

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
        $this->validate();
        \App\Models\Category::create([
            'name' => $this->name
        ]);

        $this->name = null;
        $this->closeModal();
    }

    public function delete($id)
    {
        $category = \App\Models\Category::find($id);
        $category->delete();
    }
    public function render()
    {
        $categories = \App\Models\Category::all();
        return view('livewire.admin.category', compact('categories'))->extends('layouts.admin-app')->section('content');
    }
}