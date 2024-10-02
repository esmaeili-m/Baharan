<?php

namespace App\Livewire\Home\Profile;

use App\Models\Invoice;
use Livewire\Component;

class Invoices extends Component
{
    public $invoice_select;
    public function show_invoice($id)
    {
        $this->invoice_select=Invoice::where('id', $id)->where('user_id',auth()->user()->id)->first();
    }

    public function all_invoice()
    {
        $this->invoice_select=null;
    }
    public function getTotalPrice()
    {
        $total = 0;
        foreach ($this->invoice_select->products as $product) {
            $total += $product['price'] * $product['order'];
        }
        return number_format($total);
    }
    public function render()
    {
        $invoices=Invoice::where('user_id',auth()->user()->id)->latest()->get();
        return view('livewire.home.profile.invoices',compact('invoices'))->layout('layouts.home');
    }
}
