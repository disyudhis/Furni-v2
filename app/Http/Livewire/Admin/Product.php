<?php

namespace App\Http\Livewire\Admin;

use App\Models\Category;
use Jantinnerezo\LivewireAlert\LivewireAlert;
use Livewire\Component;
use Livewire\WithFileUploads;
use RealRashid\SweetAlert\Facades\Alert;

class Product extends Component
{
    use WithFileUploads;
    public $title;
    public $image;
    public $price;
    public $discount_price;
    public $category;
    public $select_product;
    public $selectedCategory;
    public $search;

    protected $rules = [
        'title' => 'required|min:1',
        'price' => 'required',
        'discount_price' => 'nullable|lt:price',
        'image' => 'required|image|mimes:jpeg,png|max:1024',
        'category' => 'required'
    ];

    public function openModal()
    {
        $this->select_product = null;
        $this->dispatchBrowserEvent('openModal');
        $this->title = null;
        $this->price = null;
        $this->discount_price = null;
        $this->image = null;
        $this->category = null;
    }

    public function closeModal()
    {
        $this->dispatchBrowserEvent('closeModal');
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function delete($id)
    {
        $product = \App\Models\Product::find($id);
        $product->delete();
        session()->flash('message', 'Product deleted successfully');
    }


    public function store()
    {
        $this->validate();
        $imagename = time() . '.' . $this->image->getClientOriginalExtension();
        $this->image->storeAs('public', $imagename);

        $formattedPrice = number_format($this->price, 2, ',', '.');
        $formattedDiscount = number_format($this->discount_price, 2, ',', '.');
        \App\Models\Product::create([
            'title' => $this->title,
            'price' => $formattedPrice,
            'discount_price' => $formattedDiscount,
            'image' => $imagename,
            'category_id' => $this->category
        ]);
        $this->title = null;
        $this->price = null;
        $this->discount_price = null;
        $this->image = null;
        $this->category = null;
        $this->closeModal();
        session()->flash('message', 'Product successfully added.');
    }

    public function update()
    {
        $this->validate();
        $imagename = null;
        if ($this->image) {
            $imagename = time() . '.' . $this->image->getClientOriginalExtension();
            $this->image->storeAs('public', $imagename);
        }
        $formattedPrice = number_format($this->price, 2, ',', '.');
        $formattedDiscount = number_format($this->discount_price, 2, ',', '.');
        $this->select_product->update([
            'title' => $this->title,
            'price' => $formattedPrice,
            'discount_price' => $formattedDiscount,
            'image' => $imagename,
            'category_id' => $this->category
        ]);

        $this->title = null;
        $this->price = null;
        $this->discount_price = null;
        $this->image = null;
        $this->category = null;
        $this->closeModal();
    }

    public function edit($id)
    {
        $this->openModal();
        $product = \App\Models\Product::find($id);
        $this->select_product = $product;
        $this->title = $product->title;
        $this->price = $product->price;
        $this->discount_price = $product->discount_price;
        if ($product->image != null) {
            $this->image = $product->image;
        }
        $this->category = $product->category_id;
    }

    public function render()
    {
        $products = \App\Models\Product::query();
        if ($this->selectedCategory) {
            $products->where('category_id', $this->selectedCategory);
        }
        if ($this->search) {
            $products = $products->whereRaw('LOWER(title) LIKE ?', ['%' . strtolower($this->search) . '%']);
        }
        $products = $products->get();
        $categories = Category::all();
        return view('livewire.admin.product', compact('categories', 'products'))->extends('layouts.admin-app')
            ->section('content');

    }
}