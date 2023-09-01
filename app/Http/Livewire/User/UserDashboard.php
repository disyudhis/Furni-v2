<?php

namespace App\Http\Livewire\User;

use App\Models\Cart;
use App\Models\Product;
use Livewire\Component;
use App\Models\Category;

class UserDashboard extends Component
{
    public $search;
    public $selectedCategory;

    public function add_cart($id)
    {
        $existingCart = Cart::where('user_id', auth()->id())
            ->where('product_id', $id)
            ->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + 1,
            ]);
        } else {
            $product = Product::find($id);
            Cart::create([
                'user_id' => auth()->id(),
                'product_id' => $id,
                'name' => $product->name,
                'price' => $product->price,
                'quantity' => 1
            ]);
        }

        return redirect('/cart')->with('message', 'Product added to cart');
    }

    public function render()
    {
        $products = Product::query();
        if ($this->selectedCategory) {
            $products->where('category_id', $this->selectedCategory);
        }
        if ($this->search) {
            $products = $products->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($this->search) . '%']);
        }
        $products = $products->get();
        $categories = Category::all();
        return view('livewire.user.dashboard', compact('products', 'categories'))->extends('layouts.user-app')->section('content');
    }
}