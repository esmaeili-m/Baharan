<?php

namespace App\Livewire\Dashboard\Category;

use App\Models\Category;
use Livewire\Component;

class Trash extends Component
{
    public function delete($id)
    {
        $item=Category::onlyTrashed()->find($id);
        if ($item->image){
            unlink($item->image);
        }
        $item->forceDelete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function restore($id)
    {
        Category::onlyTrashed()->find($id)->restore();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بازگردانی شد');
    }
    public function render()
    {
        $data=Category::onlyTrashed()->paginate(10);
        return view('livewire.dashboard.category.trash',compact('data'));
    }
}
