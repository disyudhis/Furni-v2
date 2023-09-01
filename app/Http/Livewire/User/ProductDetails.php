<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class ProductDetails extends Component
{
    public function render()
    {
        return view('livewire.user.product-details')->extends('layouts.app')->section('content');
    }
}
