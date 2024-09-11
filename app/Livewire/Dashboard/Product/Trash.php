<?php

namespace App\Livewire\Dashboard\Product;

use App\Models\Product;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Trash extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$phone,$role_id,$code_meli,$status,$users,$barcode,$category_id;
    public $sort,$paginate_count=20,$search;
    public function mount()
    {
        if (session()->has('message')){
            $this->dispatch('alert',icon:'success',message:session()->get('message'));
        }
    }

    public function delete($id)
    {
        Product::withTrashed()->find($id)->forceDelete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function restore($id)
    {
        Product::onlyTrashed()->find($id)->restore();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بازگردانی شد');
    }
    public function fillter()
    {
        if ( $this->name || $this->barcode ||$this->status || $this->category_id ){
            $this->search=1;
            $this->users=Product::onlyTrashed();
            if ($this->name){
                $this->users->where('name','LIKE','%'.$this->name.'%');
            }
            if ($this->barcode){
                $this->users->where('barcode','LIKE','%'.$this->barcode.'%');
            }
            if ($this->status){
                $this->users->where('status',$this->status);
            }
            if ($this->category_id){
                $this->users->where('category_id',$this->category_id);
            }
            $this->users=$this->users->pluck('id');
        }else{
            $this->search=0;

        }
    }
    public function reset_search()
    {
        $this->reset(['name','barcode','status','category_id']);
        $this->search=null;
    }
    public function render()
    {
        $data=Product::onlyTrashed();
        if ($this->search){
            $data=$data->whereIn("id",$this->users)->paginate($this->paginate_count);
        }else{
            $data=$data->paginate($this->paginate_count);
        }
        return view('livewire.dashboard.product.trash',compact('data'));
    }
}
