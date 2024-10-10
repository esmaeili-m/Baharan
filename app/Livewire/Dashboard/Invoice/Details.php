<?php

namespace App\Livewire\Dashboard\Invoice;

use App\Models\Invoice;
use Livewire\Component;

class Details extends Component
{
    public $invoice;
    public $type=['1'=>'عدد','2'=>'کیلو گرم'];

    public function getTotalPrice()
    {
        $total = 0;
        foreach ($this->invoice->products as $product) {
            $total += $product['price'] * $product['order'];
        }
        return number_format($total);
    }
    public function mount($id)
    {
        $this->invoice = Invoice::find($id);
    }
    public function render()
    {
        return view('livewire.dashboard.invoice.details');
    }
}
