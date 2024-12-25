<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Redirect extends Component
{
    public $token;
    public $getMethod;

    public function mount($token=null, $getMethod=null)
    {
        $this->token = $token;
        $this->getMethod = $getMethod;
    }


    public function render()
    {
        return view('livewire.home.redirect')->layout('layouts.home');
    }
}
