<?php

namespace App\Livewire\Dashboard\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $item,$title,$slug,$parent_id,$description,$image;

    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:categories,slug,' . $this->item->id,
        ];
    }


    protected $messages = [
        'title.required' => 'این فیلد الزامی می باشد',
        'slug.required' => 'این فیلد الزامی می باشد',
        'slug.unique' => 'این عنوان استفاده شده است لطفا عنوان دیگری را وارد کنید',
    ];

    public function mount($id)
    {
        $this->item=Category::find($id);
        $this->title=$this->item->title;
        $this->slug=$this->item->slug;
        $this->parent_id=$this->item->parent_id;
        $this->description=$this->item->description;
        $this->image=$this->item->image;
    }
    public function save()
    {
        $this->validate();
        $this->item->update([
            'title'=>$this->title,
            'slug'=>$this->slug,
            'image'=>$this->image,
            'description'=>$this->description,
            'parent_id'=>$this->parent_id,
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
    public function render()
    {
        return view('livewire.dashboard.category.update');
    }
}
