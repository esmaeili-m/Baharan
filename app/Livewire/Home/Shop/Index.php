<?php

namespace App\Livewire\Home\Shop;

use App\Models\Category;
use Livewire\Component;

class Index extends Component
{
    public function render()
    {
        return view('livewire.home.shop.index')->layout('layouts.home');
    }
}
