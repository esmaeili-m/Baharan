<?php

namespace App\Livewire\Home\Shop;

use App\Models\Category;
use App\Models\Invoice;
use App\Models\Setting;
use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Facades\Verta;
use Livewire\Component;

class Index extends Component
{
    public $has_invoice,$edit;

    public function edit_invoice()
    {
        $this->edit=1;
    }
    public $openingTime,$closingTime,$now;


    public function mount()
    {
        $shop = Setting::find(1);
        $this->openingTime = Verta::parse($shop->sales_date_start)->datetime()->format('Y-m-d\TH:i:s'); // ISO 8601 format
        $this->closingTime = Verta::parse($shop->sales_date_end)->datetime()->format('Y-m-d\TH:i:s'); // ISO 8601 format
        $this->now = Verta::now()->datetime()->format('Y-m-d\TH:i:s');
        if ($shop && $shop->status == 2) {
            $startDate = Verta::parse($shop->sales_date_start);
            $endDate = Verta::parse($shop->sales_date_end);
            $now = Verta::now();
            if (!($now->between($startDate, $endDate))) {
                abort(403, 'زمان سفارش‌گیری به پایان رسیده است.');
            }
        }else{
            abort(403,'فروشگاه بسته می باشد');
        }
        if (auth()->user()->status != 3) {
            abort(403,'شما به این صفحه دسترسی ندارید');
        }
        $this->has_invoice=Invoice::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)
            ->first();
        if ($this->has_invoice){
            $this->edit=1;
        }
    }
    public function render()
    {
        return view('livewire.home.shop.index')->layout('layouts.home');
    }
}
