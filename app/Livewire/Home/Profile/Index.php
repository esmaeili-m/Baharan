<?php

namespace App\Livewire\Home\Profile;

use Livewire\Attributes\On;
use Livewire\Component;

class Index extends Component
{
    public $status=1;
    #[On('change-content')]
    public function change_status($status)
    {
        if($status==2){
            return redirect()->route('shop.index');
        }
       $this->status=$status;

    }
    public function render()
    {
        return view('livewire.home.profile.index')->layout('layouts.home');
    }
}
