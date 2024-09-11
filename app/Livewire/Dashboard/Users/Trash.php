<?php

namespace App\Livewire\Dashboard\Users;

use App\Models\User;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Trash extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$phone,$role_id,$code_meli,$status,$users;
    public $sort,$paginate_count=20,$search;
    public function restore($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $user->restore();
            $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بازگردانی شد');
        }
    }

    public function delete($id)
    {
        $user = User::withTrashed()->find($id);
        if ($user) {
            $existingUser = User::where('code_meli', $user->code_meli)
                ->orWhere('email', $user->email)
                ->orWhere('phone', $user->phone)
                ->whereNull('deleted_at')
                ->first();
            if ($existingUser) {
                $this->dispatch('alert',icon:'error',message:'کاربری با کدملی ، ایمیل  و یا شماره همراه مشابه قرار دارد');
            } else {
                $user->forceDelete();
                $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
            }

        }
    }

    public function fillter()
    {
        if ( $this->name || $this->phone || $this->code_meli ||$this->role_id  ||$this->status  ){
            $this->search=1;
            $this->users=User::onlyTrashed();
            if ($this->name){
                $this->users->where('name','LIKE','%'.$this->name.'%');
            }
            if ($this->phone){
                $this->users->where('phone','LIKE','%'.$this->phone.'%');
            }
            if ($this->code_meli){
                $this->users->where('code_meli','LIKE','%'.$this->code_meli.'%');
            }
            if ($this->role_id){
                $this->users->where('role_id',$this->role_id);
            }
            if ($this->status){
                $this->users->where('status',$this->status);
            }
            $this->users=$this->users->pluck('id');
        }else{
            $this->search=0;

        }
    }

    public function reset_search()
    {
        $this->reset(['name','phone','role_id','status','code_meli']);
        $this->search=null;
    }
    public function render()
    {
        $data=User::onlyTrashed();
        if ($this->search){
            $data=$data->whereIn("id",$this->users)->paginate($this->paginate_count);
        }else{
            $data=$data->paginate($this->paginate_count);
        }
        return view('livewire.dashboard.users.trash',compact('data'));
    }
}
