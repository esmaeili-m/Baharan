<?php

namespace App\Livewire\Dashboard\Product;

use App\Models\Invoice;
use App\Models\Product;
use Carbon\Carbon;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$phone,$role_id,$code_meli,$status,$users,$barcode,$category_id;
    public $sort,$paginate_count=20,$search;
    public $type=['1'=>'عدد','2'=>'کیلو گرم'];

    public function mount()
    {
        if (session()->has('message')){
            $this->dispatch('alert',icon:'success',message:session()->get('message'));
        }

    }

    public function delete($id)
    {
        Product::find($id)->delete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }

    public function fillter()
    {
        if ( $this->name || $this->barcode ||$this->status || $this->category_id ){
            $this->search=1;
            $this->users=Product::query();
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
    public function change_status($id)
    {
        $item=Product::find($id);
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
    public function reset_search()
    {
        $this->reset(['name','barcode','status','category_id']);
        $this->search=null;
    }
    public function render()
    {
        $data=Product::query();
        if ($this->search){
            $data=$data->whereIn("id",$this->users)->paginate($this->paginate_count);
        }else{
            $data=$data->paginate($this->paginate_count);
        }
        return view('livewire.dashboard.product.index',compact('data'));
    }
}
