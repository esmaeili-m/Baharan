<?php

namespace App\Livewire\Home\Profile;

use Illuminate\Support\Facades\Auth;
use Livewire\Component;

class Sidebar extends Component
{
    public function change_status($status)
    {

    }

    public function logout()
    {
        Auth::logout();
        return redirect()->route('user.login');
    }
    public function render()
    {
        return view('livewire.home.profile.sidebar');
    }
}
