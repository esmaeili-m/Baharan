<?php

namespace App\Livewire\Dashboard\Users;

use App\Exports\UsersExport;
use App\Models\User;
use Illuminate\Support\Facades\Gate;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;
use Maatwebsite\Excel\Excel;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $name,$phone,$role_id,$code_meli,$status,$users;
    public $sort,$paginate_count=20,$search;
    public function mount()
    {
        $this->authorize('list-users');
        if (session()->has('message')){
            $this->dispatch('alert',icon:'success',message:session()->get('message'));
        }

    }

    public function export_excel()
    {
        if ($this->search){
            return (new UsersExport($this->users->toArray() ?? []))->download('users.xlsx');

        }else{
            return (new UsersExport([]))->download('users.xlsx');

        }
    }
    public function delete($id)
    {
        $this->authorize('delete-users');
        $item=User::find($id);
        create_log(3,auth()->user()->id,'کاربران','[ '.$id.' => '.$item->name.' ]');
        $item->delete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }

    public function fillter()
    {
        if ( $this->name || $this->phone || $this->code_meli ||$this->role_id  ||$this->status  ){
            $this->search=1;
            $this->users=User::with('transaction');
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
        $data=User::with('transaction');
        if ($this->search){
            $data=$data->whereIn("id",$this->users)->paginate($this->paginate_count);
        }else{
            $data=$data->paginate($this->paginate_count);
        }
        return view('livewire.dashboard.users.index',compact('data'));
    }
}
