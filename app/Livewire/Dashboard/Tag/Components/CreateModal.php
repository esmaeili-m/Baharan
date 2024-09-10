<?php

namespace App\Livewire\Dashboard\Tag\Components;

use App\Models\Tags;
use Livewire\Attributes\On;
use Livewire\Component;

class CreateModal extends Component
{
    public $title,$link,$tag;
    protected $rules=[
        'title'=>'required',
        'link' => 'required',
    ];
    protected $messages=[
        'title.required'=>' این فیلد الزامی می باشد',
        'link.required'=>'این فیلد الزامی می باشد',
    ];
    public function save()
    {
        $this->validate();
        if ($this->tag){
            $this->tag->update([
                'title'=>$this->title,
                'link'=>$this->link,
            ]);
            $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بروزرسانی شد');

        }else{
            Tags::create([
                'title'=>$this->title,
                'link'=>$this->link,
            ]);
            $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت ایجاد شد');
        }

        $this->dispatch('close_modal');
        $this->dispatch('update_data');
    }

    public function close()
    {
        $this->reset();

    }

    #[On('sendTagId')]
    public function sendTagId($id)
    {
        $this->tag=Tags::find($id);
        $this->title=$this->tag->title;
        $this->link=$this->tag->link;
    }
    public function render()
    {
        return view('livewire.dashboard.tag.components.create-modal');
    }
}
