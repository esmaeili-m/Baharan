<?php

namespace App\Livewire\Dashboard\Invoice;

use App\Models\Invoice;
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
                'count_product' => 'required|array',
                'options' => 'required|array',
                'price' => 'required'
            ],
            [
                'user_id.required' => 'وارد کردن کاربر الزامی است.',
                'date.required' => 'وارد کردن تاریخ الزامی است.',
                'count_product.required' => 'وارد کردن مقدار محصول الزامی است.',
                'count_product.array' => 'وارد کردن مقدار محصول الزامی است.',
                'price.required' => 'وارد کردن قیمت الزامی است.'
            ]
        );
        $product_invoice=[];
        foreach ($this->options as $key => $product) {
                    $product_invoice[$key]['name'] = $product->name;
                    $product_invoice[$key]['type'] = $product->type;
                    $product_invoice[$key]['image'] = $product->image;
                    $product_invoice[$key]['barcode'] = $product->barcode;
                    $product_invoice[$key]['price'] = $product->price;
                    $product_invoice[$key]['stock'] = $product->stock;
                    $product_invoice[$key]['order'] = $this->count_product[$product->id];
        }
        Invoice::create([
            'user_id' => $this->user_id,
            'barcode' => $this->get_barcode(),
            'created_by' => auth()->user()->id,
            'products' => $product_invoice,
            'status'=>1,
            'price' => array_sum($this->price)
        ]);
    }
    public function get_barcode()
    {
        $max=Invoice::max('barcode');
        return $max == 0 ? $max=10000 : $max+1;
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
