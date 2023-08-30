<?php

namespace App\Http\Livewire\Admin;

use Livewire\Component;

class AdminDashboard extends Component
{
    public $title;
    public function render()
    {
        return view('livewire.admin.dashboard')
            ->extends('layouts.admin-app')
            ->section('content');
    }
}