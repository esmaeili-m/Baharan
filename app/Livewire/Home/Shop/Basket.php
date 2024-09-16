<?php

namespace App\Livewire\Home\Shop;

use Carbon\Carbon;
use Hekmatinasser\Verta\Verta;
use Livewire\Component;

class Basket extends Component
{
    public $openingTime;  // ساعت باز شدن
    public $closingTime;  // ساعت بسته شدن
    public $remainingTime;

    public function mount()
    {
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

    public function render()
    {
        return view('livewire.home.shop.basket');
    }
}
