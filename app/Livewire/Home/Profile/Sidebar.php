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
        $shop = Setting::find(1);
        $this->openingTime = Verta::parse($shop->sales_date_start)->format('Y-m-d\TH:i:s'); // ISO 8601 format
        $this->closingTime = Verta::parse($shop->sales_date_end)->format('Y-m-d\TH:i:s'); // ISO 8601 format
        $this->now = Verta::now()->format('Y-m-d\TH:i:s'); // ISO 8601 format
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
