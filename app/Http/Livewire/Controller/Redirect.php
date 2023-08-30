<?php

namespace App\Http\Livewire\Controller;

use App\Models\Product;
use Livewire\Component;
use App\Models\Category;
use Illuminate\Support\Facades\Auth;

class Redirect extends Component
{
    public function render()
    {
        $usertype = Auth::user()->usertype;
        $category = Category::all();
        $product = Product::orderBy('updated_at', 'desc')->get();

        if ($usertype == '1') {
            return view('livewire.controller.redirect', compact('category', 'product'));
        } else {
            $product = Product::paginate(10);
            return view('livewire.controller.redirect', compact('product'));
        }
    }
}