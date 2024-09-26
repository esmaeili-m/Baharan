<?php

namespace App\Livewire\Home\Profile;

use App\Models\User;
use Livewire\Component;

class UserInformation extends Component
{
    public $user,$name,$phone,$code_meli,$father,$address,$type,
        $license_number,$license_image,$avatar,$years,$month,$day,
        $license_years,$license_month,$license_day;
    public function mount()
    {
        $this->user=auth()->user();
        if ($this->user){
            $this->name=$this->user->name;
            $this->phone=$this->user->phone;
            $this->code_meli=$this->user->code_meli;
            $this->father=$this->user->father;
            $this->address=$this->user->address;
            $this->type=$this->user->type;
            $this->license_number=$this->user->license_number;
            $this->license_image=$this->user->license_image;
            $this->avatar=$this->user->avatar;
            list($this->years,$this->month,$this->day)=explode('-',$this->user->birthday);
            list($this->license_years,$this->license_month,$this->license_day)=explode('-',$this->user->license_date);
        }
    }
    public function render()
    {
        return view('livewire.home.profile.user-information');
    }
}
