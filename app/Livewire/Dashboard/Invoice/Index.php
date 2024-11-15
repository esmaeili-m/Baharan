<?php

namespace App\Livewire\Dashboard\Invoice;

use App\Exports\InvoicesExport;
use App\Exports\UsersExport;
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
    public $sort,$paginate_count=20,$search,$user_id;
    public $type=['1'=>'عدد','2'=>'کیلو گرم'];

    public function mount()
    {
        if (session()->has('message')){
            $this->dispatch('alert',icon:'success',message:session()->get('message'));
        }
    }

    public function export_excel()
    {
        if ($this->search){
            return (new InvoicesExport($this->invoices->toArray() ?? []))->download('invoices.xlsx');

        }else{
            return (new InvoicesExport([]))->download('invoices.xlsx');

        }
    }
    public function change_status($id,$status)
    {
        $item=Invoice::find($id);
        $item->update([
                'status'=>$status
        ]);
        create_log(6,auth()->user()->id,'فاکتور ها','[ '.$item->id.' => '.$this->barcode.' ]');

        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بروزرسانی شد');

    }
    public function fillter()
    {
        $invoices=Invoice::query();
        if ( $this->barcode || $this->status  || $this->from || $this->to || $this->user_id  ){
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
            if ($this->status){
                $invoices=$invoices->where('status',$this->status);

            }
            if ($this->user_id){
                $invoices=$invoices->where('user_id',$this->user_id);

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
            $data=$data->whereIn("id",$this->invoices) ->with(['user' => function($query) {
                $query->select('id', 'name','code_meli');
            }])->paginate($this->paginate_count);
        }else{
            $data=$data->with(['user' => function($query) {
                $query->select('id', 'name','code_meli');
            }])->paginate($this->paginate_count);
        }
        return view('livewire.dashboard.invoice.index',compact('data'));
    }
}
