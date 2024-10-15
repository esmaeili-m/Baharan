<?php

namespace App\Livewire\Dashboard;

use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Logs extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $title,$status,$categories;
    public $sort,$paginate_count=20,$search;
    public function mount()
    {
        if (session()->has('message')){
            $this->dispatch('alert',icon:'success',message:session()->get('message'));
        }
    }

    public function delete($id)
    {
        $category=Category::find($id);
        create_log('حذف موقت',auth()->user()->id,'دسته بندی','[ '.$id.' => '.$category->name);
        $category->delete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
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
        create_log('تغییر وضعیت',auth()->user()->id,'دسته بندی',$id);

        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بروزرسانی شد');

    }
    public function fillter()
    {
        if ( $this->title || $this->status  ){
            $this->search=1;
            $this->categories=Category::query();
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
        $data=\App\Models\Logs::query();
        if ($this->search){
            $data=$data->whereIn("id",$this->categories)->orderBy('id','desc')->paginate($this->paginate_count);
        }else{
            $data=$data->orderBy('id','desc')->paginate($this->paginate_count);
        }
        return view('livewire.dashboard.logs',compact('data'));
    }
}
