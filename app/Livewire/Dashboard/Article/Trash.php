<?php

namespace App\Livewire\Dashboard\Article;

use App\Models\Article;
use Livewire\Component;

class Trash extends Component
{
    public function delete($id)
    {
        $item=Article::onlyTrashed()->find($id);
        if ($item->image){
            unlink($item->image);
        }
        $item->forceDelete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function restore($id)
    {
        Article::onlyTrashed()->find($id)->restore();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بازگردانی شد');
    }
    public function render()
    {
        $data=Article::onlyTrashed()->paginate(10);
        return view('livewire.dashboard.article.trash',compact('data'));
    }
}
