<?php

namespace App\Livewire\Dashboard\Role;

use App\Models\Role;
use Livewire\Component;

class Update extends Component
{
    public $title,$role;
    protected $rules=[
        'title'=>'required',
    ];
    protected $messages=[
        'title.required'=>' این فیلد الزامی می باشد',
    ];

    public function mount($id)
    {
        $this->role=Role::find($id);
        $this->title=$this->role->title;
    }
    public function save()
    {
        $this->validate();
        $this->role->update([
            'title'=>$this->title,
        ]);
        create_log(2,auth()->user()->id,'نقش ها','[ '.$this->role->id.' => '.$this->title.' ]');
        session()->flash('message','نقش با موفقیت ویرایش شد');
        return redirect()->route('role.list');
    }
    public function render()
    {
        return view('livewire.dashboard.role.update');
    }
}
