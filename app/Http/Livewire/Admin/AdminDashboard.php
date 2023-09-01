<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use Livewire\Component;

class AdminDashboard extends Component
{
    public function render()
    {
        $orders = Order::all();
        $products = Product::all();
        $categories = Category::all();
        return view('livewire.admin.dashboard', compact('products', 'categories', 'orders'))
            ->extends('layouts.admin-app')
            ->section('content');
    }
}