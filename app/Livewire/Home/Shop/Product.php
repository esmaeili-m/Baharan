<?php

namespace App\Livewire\Home\Shop;

use Livewire\Attributes\On;
use Livewire\Component;

class Product extends Component
{
    public $product,$category;

    #[On('set-category')]
    public function category($categoryId)
    {
        $this->category=\App\Models\Category::with('products')->find($categoryId);
    }
    public function render()
    {
        return view('livewire.home.shop.product');
    }
}
