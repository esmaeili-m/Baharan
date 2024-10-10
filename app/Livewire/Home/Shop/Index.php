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
        if (auth()->user()->status != 3) {
            abort(403,'شما به این صفحه دسترسی ندارید');
        }
        $this->has_invoice=Invoice::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)
            ->where('status',1)
            ->first();
    }
    public function render()
    {
        return view('livewire.home.shop.index')->layout('layouts.home');
    }
}
