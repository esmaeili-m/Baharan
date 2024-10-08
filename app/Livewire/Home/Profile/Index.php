<?php

namespace App\Livewire\Home\Profile;

use Livewire\Attributes\On;
use Livewire\Attributes\Url;
use Livewire\Component;

class Index extends Component
{
    #[Url]
    public $status=1;
    #[On('change-content')]
    public function change_status($status)
    {
        if($status==2){
            return redirect()->route('shop.index');
        }
       $this->status=$status;
       $this->dispatch('contentChanged');
    }

    public function mount()
    {
        if (request()->has('status')) {
            $this->status = request()->status;

            $this->dispatch('contentChanged');

        }

    }
    public function render()
    {
        return view('livewire.home.profile.index')->layout('layouts.home');
    }
}
