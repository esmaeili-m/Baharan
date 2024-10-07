<?php

namespace App\Livewire\Dashboard\Invoice;

use App\Models\Product;
use Livewire\Component;

class Create extends Component
{
    public $user_id,$date,$products,$options,$option,$price=[],$count_product=[];
    public $type=['1'=>'عدد','2'=>'کیلو گرم'];

    public function save()
    {
        $this->validate(
            [
                'user_id' => 'required',
                'date' => 'required',
                'count_product' => 'required|same:options',
                'options' => 'required',
                'price' => 'required'
            ],
            [
                'user_id.required' => 'وارد کردن کاربر الزامی است.',
                'date.required' => 'وارد کردن تاریخ الزامی است.',
                'count_product.required' => 'وارد کردن مقدار محصول الزامی است.',
                'count_product.same' => 'وارد کردن مقدار محصول الزامی است.',
                'price.required' => 'وارد کردن قیمت الزامی است.'
            ]
        );

    }
    public function mount()
    {
    }
    public function UpdatedOption(){
        if (!$this->options) {
            $this->options[]=Product::find($this->option);
        }else{
            if (!collect($this->options)->contains('id', $this->option)) {
                $this->options[] = Product::find($this->option);
            }

        }
    }
    public function UpdatedCountProduct($value , $key)
    {
        $price=Product::find($key)->price;
        $this->price[$key]=$value*$price;
    }

    public function removeProduct($id)
    {
        unset($this->price[$id]);
        unset($this->count_product[$id]);
        $this->options = collect($this->options)->reject(function ($item) use ($id) {
            return $item->id === $id;
        });
    }
    public function render()
    {
        return view('livewire.dashboard.invoice.create');
    }
}
