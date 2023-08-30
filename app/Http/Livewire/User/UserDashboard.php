<?php

namespace App\Http\Livewire\User;

use Livewire\Component;

class UserDashboard extends Component
{
    public $title;

    public function render()
    {
        return view('livewire.user.dashboard')->extends('layouts.user-app')->section('content');
    }
}