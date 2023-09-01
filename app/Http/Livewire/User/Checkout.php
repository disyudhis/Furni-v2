<?php

namespace App\Http\Livewire\User;

use App\Models\Product;
use Livewire\Component;

class Checkout extends Component
{
    public $totalItems;
    public $totalPrice;
    public $selectedPaymentMethod;

    public function selectPaymentMethod()
    {
        if ($this->selectedPaymentMethod === 'card') {
            dd('card');
        } elseif ($this->selectedPaymentMethod === 'cod') {
            dd('cod');
        }

        session()->flash('message', 'Metode pembayaran berhasil dipilih');
    }
    public function mount()
    {
        $this->totalPrice = request()->query('totalPrice');
        $this->totalItems = request()->query('totalItems');
    }

    public function render()
    {

        return view('livewire.user.checkout')->extends('layouts.user-app')->section('content');
    }
}