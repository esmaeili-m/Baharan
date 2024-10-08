<?php

namespace App\Livewire\Home\Shop;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class Index extends Component
{
    public $has_invoice;
    public function mount()
    {
        $this->has_invoice=Invoice::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)->first();
    }
    public function render()
    {
        return view('livewire.home.shop.index')->layout('layouts.home');
    }
}
