<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class Order extends Component
{
    public function render()
    {
        return view('livewire.admin.order')->extends('layouts.admin-app')->section('content');
    }
}