<?php

namespace App\Livewire\Dashboard\Service;

use App\Models\Services;
use Livewire\Component;

class Trash extends Component
{
    public function delete($id)
    {
        $item=Services::onlyTrashed()->find($id);
        if ($item->image){
            unlink($item->image);
        }
        $item->forceDelete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function restore($id)
    {
        Services::onlyTrashed()->find($id)->restore();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بازگردانی شد');
    }
    public function render()
    {
        $data=Services::onlyTrashed()->paginate(10);
        return view('livewire.dashboard.service.trash',compact('data'));
    }

}
