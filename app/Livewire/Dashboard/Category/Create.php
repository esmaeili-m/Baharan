<?php

namespace App\Livewire\Dashboard\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $title,$slug,$parent_id,$description,$image;
    protected $rules=[
       'title'=>'required',
       'slug' => 'required|unique:categories,slug',
    ];
    protected $messages=[
      'title.required'=>' این فیلد الزامی می باشد',
      'slug.required'=>'این فیلد الزامی می باشد',
      'slug.unique'=>'این عنوان استفاده شده است لطفا عنوان دیگری را وارد کنید',
    ];

    public function mount()
    {
        $this->parent_id=Category::first()->id ?? null;
    }
    public function save()
    {
        $this->validate();
        Category::create([
           'title'=>$this->title,
           'slug'=>$this->slug,
           'image'=>$this->image,
           'description'=>$this->description,
           'parent_id'=>$this->parent_id,
           'order'=>$this->get_order()
        ]);
        session()->flash('message','دسته بندی با موفقیت ایجاد شد');
        return redirect()->route('category.list');
    }

    public function UpdatedSlug()
    {
        $this->slug=str_replace(' ','-',$this->slug);
    }
    public function UpdatedImage()
    {
        $this->image=upload_file($this->image,'categories');
    }

    public function get_order()
    {
        $max=Category::max('order');
        return $max == 0 ? $max=1 : $max+1;
    }
    public function render()
    {
        return view('livewire.dashboard.category.create');
    }
}
