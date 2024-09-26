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

    public function render()
    {
        $invoices=Invoice::where('user_id',auth()->user()->id)->latest()->get();
        return view('livewire.home.profile.invoices',compact('invoices'))->layout('layouts.home');
    }
}
