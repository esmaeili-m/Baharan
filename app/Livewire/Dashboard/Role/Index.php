<?php

namespace App\Livewire\Dashboard\Role;

use App\Models\Role;
use Livewire\Component;

class Index extends Component
{
    public function mount()
    {
        if (session()->has('message')){
            $this->dispatch('alert',icon:'success',message:session()->get('message'));
        }
    }
    public function delete($id)
    {
        Role::find($id)->delete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function change_status($id)
    {
        $item=Role::find($id);
        if ($item->status == 1){
            $item->update([
                'status'=>2
            ]);
        }else{
            $item->update([
                'status'=>1
            ]);
        }
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بروزرسانی شد');

    }
    public function render()
    {
        $data=Role::get();
        return view('livewire.dashboard.role.index',compact('data'));
    }
}
