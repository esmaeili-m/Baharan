<?php

namespace App\Livewire\Home\Shop;

use App\Models\User;
use Livewire\Attributes\On;
use Livewire\Component;

class Product extends Component
{
    public $product,$category,$type=['1'=>'عدد','2'=>'کیلو گرم'];

    public function add_to_basket($id)
    {;
        $product=\App\Models\Product::where('id',$id)->where('stock','>',0)->where('status',2)->first();
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
    #[On('update-stock')]
    public function update_stock()
    {
        if ($this->category){
            $this->category=\App\Models\Category::with('products')->find($this->category->id);
        }
    }
    public function render()
    {
        return view('livewire.home.shop.product');
    }
}
