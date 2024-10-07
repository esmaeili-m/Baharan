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
        Role::create([
            'title'=>$this->title,
            'status'=>2
        ]);
        session()->flash('message','نقش با موفقیت ایجاد شد');
        return redirect()->route('role.list');
    }
    public function render()
    {
        return view('livewire.dashboard.role.create');
    }
}
