<?php

namespace App\Livewire\Dashboard\Invoice;

use App\Models\Invoice;
use Hekmatinasser\Verta\Facades\Verta;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $barcode,$status,$invoices,$from,$to;
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
        Invoice::find($id)->update(['status'=>3]);
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت کنسل شد');
    }
    public function change_status($id)
    {
        $item=Invoice::find($id);
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
        $invoices=Invoice::query();
        if ( $this->barcode || $this->status  || $this->from || $this->to  ){
            if ($this->from || $this->to) {
                if ($this->from) {
                    $fromDate = Verta::parse($this->from)->startDay()->toCarbon();
                    $invoices = $invoices->where('created_at', '>=', $fromDate);
                }

                if ($this->to) {
                    $toDate = Verta::parse($this->to)->endDay()->toCarbon();
                    $invoices = $invoices->where('created_at', '<=', $toDate);
                }

                if ($this->from && $this->to) {
                    $invoices = $invoices->whereBetween('created_at', [$fromDate, $toDate]);
                }
            }
            if ($this->barcode){
                $barcode = preg_replace('/\D/', '', $this->barcode);
                $invoices=$invoices->where('barcode',$barcode);
            }
            $this->invoices=$invoices->pluck('id');
            $this->search=1;
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
        $data=Invoice::query();
        if ($this->search){
            $data=$data->whereIn("id",$this->invoices)->paginate($this->paginate_count);
        }else{
            $data=$data->paginate($this->paginate_count);
        }
        return view('livewire.dashboard.invoice.index',compact('data'));
    }
}
