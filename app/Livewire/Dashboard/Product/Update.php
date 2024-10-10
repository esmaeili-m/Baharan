<?php

namespace App\Livewire\Dashboard\Product;

use App\Models\Category;
use App\Models\Product;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $name,$status,$category_id,$price,$stock,$description,$image,$product,$min,$max,$type=1;
    protected $rules=[
        'name'=>'required',
        'stock'=>'required|numeric',
        'price'=>'required|numeric',
        'min'=>'required|numeric|lte:stock',
        'max'=>'required|numeric|lte:stock|gte:min',
        'category_id'=>'required',
        'description' => 'nullable',
        'image' => 'nullable',
    ];
    protected $messages = [
        'name.required' => 'فیلد نام الزامی می‌باشد',
        'stock.required' => 'فیلد موجودی الزامی می‌باشد',
        'stock.numeric' => 'فیلد موجودی باید یک عدد باشد',
        'price.required' => 'فیلد قیمت الزامی می‌باشد',
        'price.numeric' => 'فیلد قیمت باید یک عدد باشد',
        'min.required' => 'فیلد حداقل الزامی می‌باشد',
        'min.numeric' => 'فیلد حداقل باید یک عدد یا قلولن باشد',
        'min.lte' => 'فیلد حداقل نباید بیشتر از موجودی باشد',
        'max.required' => 'فیلد حداکثر الزامی می‌باشد',
        'max.numeric' => 'فیلد حداکثر باید یک عدد یا قلولن باشد',
        'max.lte' => 'فیلد حداکثر نباید بیشتر از موجودی باشد',
        'max.gte' => 'فیلد حداکثر نباید کمتر از فیلد حداقل باشد',
        'category_id.required' => 'فیلد دسته‌بندی الزامی می‌باشد',
        'description.nullable' => 'فیلد توضیحات می‌تواند خالی باشد',
        'image.nullable' => 'فیلد تصویر می‌تواند خالی باشد',
    ];
    public function mount($id)
    {
        $this->product=Product::find($id);
        $this->name=$this->product->name;
        $this->price=$this->product->price;
        $this->min=$this->product->min;
        $this->max=$this->product->max;
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
