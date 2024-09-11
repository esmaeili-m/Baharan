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
        ];
    }


    protected $messages = [
        'title.required' => 'این فیلد الزامی می باشد',
    ];

    public function mount($id)
    {
        $this->item=Category::find($id);
        $this->title=$this->item->title;
        $this->description=$this->item->description;
        $this->image=$this->item->image;
    }
    public function save()
    {
        $this->validate();
        $this->item->update([
            'title'=>$this->title,
            'image'=>$this->image,
            'description'=>$this->description,
        ]);
        session()->flash('message','دسته بندی با موفقیت ایجاد شد');
        return redirect()->route('category.list');
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
