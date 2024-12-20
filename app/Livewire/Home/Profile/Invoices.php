<?php

namespace App\Livewire\Home\Profile;

use App\Models\Invoice;
use Hekmatinasser\Verta\Facades\Verta;
use Livewire\Component;

class Invoices extends Component
{
    public $invoice_select,$barcode,$from,$to,$fillter=0,$search;
    public $type=['1'=>'عدد','2'=>'کیلو گرم'];

    public function show_invoice($id)
    {
        $this->invoice_select=Invoice::where('id', $id)->where('user_id',auth()->user()->id)->first();
    }

    public function all_invoice()
    {
        $this->invoice_select=null;
        $this->dispatch('contentChanged')->to(Index::class);

    }
    public function getTotalPrice()
    {
        $total = 0;
        foreach ($this->invoice_select->products as $product) {
            $total += $product['price'] * $product['order'];
        }
        return number_format($total);
    }

    public function search_invoice()
    {
        $invoices=Invoice::where('user_id',auth()->user()->id);
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
        $this->search=$invoices->pluck('id');
        $this->fillter=1;

    }

    public function mount()
    {
        if (request()->has('code')) {
            $this->invoice_select=Invoice::where('barcode', request()->get('code'))->where('user_id',auth()->user()->id)->first();

        }
    }
    public function render()
    {
        $invoices=Invoice::where('user_id',auth()->user()->id);
        if ($this->fillter){
            $invoices=$invoices->whereIn('id',$this->search);
        }
        $invoices=$invoices->latest()->get();
        $this->dispatch('contentChanged')->to(Index::class);
        return view('livewire.home.profile.invoices',compact('invoices'))->layout('layouts.home');
    }
}
