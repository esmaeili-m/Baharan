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
        $item=Role::find($id);
        create_log(3,auth()->user()->id,'نقش ها','[ '.$id.' => '.$item->title.' ]');
        $item->delete();
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
        create_log(6,auth()->user()->id,'نقش ها','[ '.$id.' => '.$item->title.' ]');

        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بروزرسانی شد');

    }
    public function render()
    {
        $data=Role::get();
        return view('livewire.dashboard.role.index',compact('data'));
    }
}
