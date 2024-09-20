<?php

namespace App\Livewire\Home\Shop;

use App\Models\User;
use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Illuminate\Support\Facades\Auth;
use Livewire\Attributes\On;
use Livewire\Component;

class Basket extends Component
{
    public $openingTime;
    public $total=0;
    public $type=['1'=>'عدد','2'=>'کیلو گرم'];
    // ساعت باز شدن
    public $products;  // ساعت باز شدن
    public $closingTime;  // ساعت بسته شدن
    public $remainingTime;
    public $invoice=[];
    public $price=[];

    #[On('add_basket')]
    public function add_basket()
    {
        $products=\App\Models\Basket::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)->pluck('product_id');
        $this->products=\App\Models\Product::whereIn('id',$products ?? [])->get();
    }

    public function remove_from_basket($id)
    {
        $products=\App\Models\Basket::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)
            ->where('product_id',$id)->delete();
        $this->products = $this->products->reject(function ($item) use ($id){
            return $item['id'] === $id; // آیتم با id برابر 2 حذف می‌شود
        });
        unset($this->invoice[$id]);
    }
    public function mount()
    {

        $products=\App\Models\Basket::whereDate('created_at', Carbon::today())->where('user_id',auth()->user()->id)->pluck('product_id');
        $this->products=\App\Models\Product::whereIn('id',$products ?? [])->get();
        $today = Verta::now()->timezone('Asia/Tehran'); // گرفتن تاریخ امروز به وقت ایران
        $this->openingTime = Verta::create($today->year, $today->month, $today->day, 1, 0, 0, 'Asia/Tehran')->DateTime();
        $this->closingTime = Verta::create($today->year, $today->month, $today->day, 3, 0, 0, 'Asia/Tehran')->DateTime();
        $this->remainingTime='00:01';
//        $this->calculateRemainingTime();
    }

    // محاسبه زمان باقی‌مانده تا بسته شدن مغازه
    public function calculateRemainingTime()
    {
        // زمان فعلی بر اساس زمان ایران
        $currentTime = Verta::now()->timezone('Asia/Tehran')->DateTime();

        // اگر زمان فعلی بعد از زمان بسته شدن بود، یعنی مغازه بسته است
        if ($currentTime >= $this->closingTime) {
            $this->remainingTime = 'مغازه بسته است';
        } elseif ($currentTime < $this->openingTime) {
            $this->remainingTime = 'مغازه هنوز باز نشده است';
        } else {
            // محاسبه تفاوت زمانی بین حال و زمان بسته شدن
            $diffInSeconds = $this->closingTime->getTimestamp() - $currentTime->getTimestamp();
            $diffInHours = floor($diffInSeconds / 3600);
            $diffInMinutes = floor(($diffInSeconds % 3600) / 60);

            // نمایش زمان باقی‌مانده به شکل HH:MM
            $this->remainingTime = sprintf('%02d:%02d', $diffInHours, $diffInMinutes);
        }
    }

    public function updatedInvoice($value, $key)
    {
        $product=\App\Models\Product::find($key);
        array_filter($this->invoice);
        $this->price[$product->id]=$value * $product->price;
    }
    public function render()
    {
        return view('livewire.home.shop.basket');
    }
}
