<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Category extends Component
{
    public function render()
    {
        return view('livewire.admin.category')->extends('layouts.admin-app')->section('content');
    }
}