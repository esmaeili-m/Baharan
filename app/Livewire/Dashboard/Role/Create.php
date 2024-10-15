<?php

namespace App\Livewire\Dashboard\Role;

use App\Models\Role;
use Livewire\Component;

class Create extends Component
{
    public $title;
    protected $rules=[
        'title'=>'required',
    ];
    protected $messages=[
        'title.required'=>' این فیلد الزامی می باشد',
    ];
    public function save()
    {
        $this->validate();
        $item=Role::create([
            'title'=>$this->title,
            'status'=>2
        ]);
        create_log(1,auth()->user()->id,'نقش ها','[ '.$item->id.' => '.$this->title.' ]');

        session()->flash('message','نقش با موفقیت ایجاد شد');
        return redirect()->route('role.list');
    }
    public function render()
    {
        return view('livewire.dashboard.role.create');
    }
}
