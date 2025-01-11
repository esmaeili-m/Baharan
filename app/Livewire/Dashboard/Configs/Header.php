<?php

namespace App\Livewire\Dashboard\Configs;

use Livewire\Component;

class Header extends Component
{
    public function logout()
    {
        auth()->logout();
        session()->flush();
        return redirect()->route('user.login');
    }
    public function render()
    {
        return view('livewire.dashboard.configs.header');
    }
}
