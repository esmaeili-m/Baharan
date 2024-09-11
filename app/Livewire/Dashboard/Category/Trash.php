<?php

namespace App\Livewire\Dashboard\Category;

use App\Models\Category;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Trash extends Component
{


    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $title,$status,$categories;
    public $sort,$paginate_count=20,$search;
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
    public function change_status($id)
    {
        $item=Category::find($id);
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
    public function fillter()
    {
        if ( $this->title || $this->status  ){
            $this->search=1;
            $this->categories=Category::onlyTrashed();
            if ($this->title){
                $this->categories->where('title','LIKE','%'.$this->title.'%');
            }
            if ($this->status){
                $this->categories->where('status',$this->status);
            }
            $this->categories=$this->categories->pluck('id');
        }else{
            $this->search=0;

        }
    }

    public function reset_search()
    {
        $this->reset(['title','status']);
        $this->search=null;
    }
    public function render()
    {
        $data=Category::onlyTrashed();
        if ($this->search){
            $data=$data->whereIn("id",$this->categories)->paginate($this->paginate_count);
        }else{
            $data=$data->paginate($this->paginate_count);
        }
        return view('livewire.dashboard.category.trash',compact('data'));
    }
}
