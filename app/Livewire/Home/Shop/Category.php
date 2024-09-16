<?php

namespace App\Livewire\Home\Shop;

use Livewire\Component;

class Category extends Component
{
    public function set_category($id)
    {
        $category=\App\Models\Category::where('id',$id)->where('status',2)->exists();
        if ($category){
            return $this->dispatch('set-category',categoryId: $id)->to(Product::class);
        }
    }
    public function render()
    {
        $categories= \App\Models\Category::where('status',2)->with('products')->get();
        return view('livewire.home.shop.category',compact('categories'));
    }
}
