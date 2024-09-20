<?php

namespace App\Livewire\Home\Shop;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Product extends Component
{
    public $product,$category;

    public function add_to_basket($id)
    {
        $user=User::find(3);
        auth()->login($user);
        $product=\App\Models\Product::where('stock','>',0)->where('status',2)->first();
        if ($product){
            \App\Models\Basket::create([
               'user_id'=>auth()->user()->id,
               'product_id'=>$id
            ]);
            $this->dispatch('add_basket')->to(Basket::class);
        }else{
            $this->dispatch('alert',icon:'',message:'موجودی این محصول تمام شده است');
        }
//        dd($product);
        sleep(5);
    }
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
