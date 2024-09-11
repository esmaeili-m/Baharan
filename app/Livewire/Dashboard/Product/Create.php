<?php

namespace App\Livewire\Dashboard\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $name,$status,$category_id,$price,$stock,$description,$image;
    protected $rules=[
        'name'=>'required',
        'stock'=>'required',
        'price'=>'required',
        'category_id'=>'required',
        'description' => 'nullable',
        'image' => 'nullable',
    ];
    protected $messages=[
        'name.required'=>' این فیلد الزامی می باشد',
        'stock.required'=>'این فیلد الزامی می باشد',
        'price.required'=>'این فیلد الزامی می باشد',
        'category_id.required'=>'این فیلد الزامی می باشد',
    ];

    public function save()
    {
        $data = $this->validate();
        $data['slug']=$this->create_slug($this->name);
        $data['order']=$this->get_order();
        $data['barcode']=$this->get_barcode();
        $data['status']=2;
        Product::create($data);
        session()->flash('message', 'محصول با موفقیت ایجاد شد');
        return redirect()->route('product.list');
    }
    public function get_order()
    {
        $max=Product::max('order');
        return $max == 0 ? $max=1 : $max+1;
    }
    public function get_barcode()
    {
        $max=Product::max('barcode');
        return $max == 0 ? $max=10000 : $max+1;
    }

    public function create_slug($text)
    {
        return str_replace(' ','-',$text).'-'.Product::max('id')+1;
    }
    public function UpdatedImage()
    {
        $this->image=upload_file($this->image,'Products');
    }

    public function mount()
    {
        $this->category_id=Category::min('id');
    }
    public function render()
    {
        return view('livewire.dashboard.product.create');
    }
}
