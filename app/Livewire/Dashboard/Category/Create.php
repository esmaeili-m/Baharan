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
    ];
    protected $messages=[
      'title.required'=>' این فیلد الزامی می باشد',
    ];
    public function save()
    {
        $this->validate();
        $item=Category::create([
           'title'=>$this->title,
           'slug'=>$this->create_slug($this->title),
           'image'=>$this->image,
           'status'=>2,
           'description'=>$this->description,
        ]);
        session()->flash('message','دسته بندی با موفقیت ایجاد شد');
        create_log(1,auth()->user()->id,'دسته بندی','[ '.$item->id.' => '.$this->title.' ]');
        return redirect()->route('category.list');
    }
    public function create_slug($text)
    {
        return str_replace(' ','-',$text).'-'.Category::max('id')+1;
    }
    public function UpdatedImage()
    {
        $this->image=upload_file($this->image,'categories');
    }

    public function render()
    {
        return view('livewire.dashboard.category.create');
    }
}
