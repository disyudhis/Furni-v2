<?php

namespace App\Http\Livewire\User;

use App\Models\Product;
use Livewire\Component;

class Cart extends Component
{
    public $cart;
    public $totalPrice = 0;
    public $itemPrice = 0;
    public $name;
    public $cardNumber;
    public $expMonth;
    public $expYear;
    public $cvc;

    public function increment($id)
    {
        $cart = \App\Models\Cart::find($id);
        if ($cart) {
            $cart->quantity++;
            $cart->save();
        }
    }

    public function decrement($id)
    {
        $cart = \App\Models\Cart::find($id);

        if ($cart) {
            if ($cart->quantity > 1) {
                $cart->quantity--;
                $cart->save();
            } else {
                $cart->delete();
                session()->flash('message', 'Product removed successfully');
            }
        }
    }
    public function delete($id)
    {
        $cart = \App\Models\Cart::find($id);
        $cart->delete();
        session()->flash('message', 'Product deleted successfully');
    }

    public function checkout($totalPrice, $totalItems)
    {

        return redirect()->route('checkout', ['totalPrice' => $totalPrice, 'totalItems' => $totalItems]);
    }

    public function store()
    {

    }

    public function openModal()
    {
        $this->dispatchBrowserEvent('openModal');
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('closeModal');
    }

    public function render()
    {
        $carts = \App\Models\Cart::where('user_id', auth()->id())
            ->join('products', 'carts.product_id', '=', 'products.id')
            ->select('products.id as product_id', 'products.*', 'carts.*')
            ->get();

        // Menghitung jumlah item
        $totalItems = $carts->sum('quantity');

        return view('livewire.user.cart', compact('carts', 'totalItems'))->extends('layouts.user-app')->section('content');
    }
}