<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Redirect extends Component
{
    public $token;
    public $getMethod;

    public function mount($token, $getMethod)
    {
        $this->token = $token;
        $this->getMethod = $getMethod;
    }


    public function render()
    {
        return view('livewire.home.redirect');
    }
}
