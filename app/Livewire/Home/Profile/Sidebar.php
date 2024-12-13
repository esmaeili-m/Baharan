<?php

namespace App\Livewire\Home\Profile;

use App\Models\Setting;
use Hekmatinasser\Verta\Facades\Verta;
use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public $openingTime,$closingTime,$now;

    public function change_status($status)
    {

    }
    public function mount()
    {
        $shop=Setting::find(1);
        $startDate = Verta::parse($shop->sales_date_start)->datetime();
        $now = Verta::parse(\verta())->datetime();
        $endDate = Verta::parse($shop->sales_date_end)->datetime();
        $this->openingTime =$startDate;
        $this->closingTime = $endDate;
        $this->now = $now;
    }
    public function logout()
    {
        Auth::logout();
        session()->flush();
        return redirect()->route('user.login');
    }
    public function render()
    {
        return view('livewire.home.profile.sidebar');
    }
}
