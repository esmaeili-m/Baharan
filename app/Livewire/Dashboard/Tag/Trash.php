<?php

namespace App\Livewire\Dashboard\Tag;

use App\Models\Tags;
use Livewire\Component;

class Trash extends Component
{
    public function delete($id)
    {
        $item=Tags::onlyTrashed()->find($id)->forceDelete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function restore($id)
    {
        Tags::onlyTrashed()->find($id)->restore();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بازگردانی شد');
    }
    public function render()
    {
        $data=Tags::onlyTrashed()->paginate(10);
        return view('livewire.dashboard.tag.trash',compact('data'));
    }
}
