<?php

namespace App\Livewire\Home;

use Livewire\Component;

class Forbiden extends Component
{
    public $message;
    public function mount($message=null)
    {
        if (request()->has('message')) {
            $this->message = request()->message;
        }
    }
    public function render()
    {
        return view('livewire.home.forbiden')->layout('layouts.home');
    }
}
