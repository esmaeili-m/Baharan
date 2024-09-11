<?php

namespace App\Livewire\Dashboard\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $name,$status,$category_id,$price,$stock,$description,$image,$product;
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
    public function mount($id)
    {
        $this->product=Product::find($id);
        $this->name=$this->product->name;
        $this->price=$this->product->price;
        $this->stock=$this->product->stock;
        $this->category_id=$this->product->category_id;
        $this->description=$this->product->description;
        $this->image=$this->product->image;
    }
    public function save()
    {
        $data = $this->validate();
        $this->product->update($data);
        session()->flash('message', 'محصول با موفقیت ویرایش شد');
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


    public function render()
    {
        return view('livewire.dashboard.product.update');
    }
}
