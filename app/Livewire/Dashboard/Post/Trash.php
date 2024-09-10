<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Posts;
use Livewire\Component;

class Trash extends Component
{
    public function delete($id)
    {
        $item=Posts::onlyTrashed()->find($id);
        if ($item->image){
            unlink($item->image);
        }
        $item->forceDelete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function restore($id)
    {
        Posts::onlyTrashed()->find($id)->restore();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بازگردانی شد');
    }
    public function render()
    {
        $data=Posts::onlyTrashed()->paginate(10);
        return view('livewire.dashboard.post.trash',compact('data'));
    }
}
