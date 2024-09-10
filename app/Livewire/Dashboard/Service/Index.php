<?php

namespace App\Livewire\Dashboard\Service;

use App\Models\Services;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $sort,$paginate_count=20;
    public function mount()
    {
        if (session()->has('message')){
            $this->dispatch('alert',icon:'success',message:session()->get('message'));
        }
    }

    public function UpdatedSort()
    {
        $counter = 1;
        foreach ($this->sort as $item) {
            Services::find($item)->update([
                'order' => $counter
            ]);
            $counter++;
        }
        $this->sort = [];
    }
    public function change_status($id)
    {
        $item=Services::find($id);
        if ($item->status){
            $item->update([
                'status'=>0
            ]);
        }else{
            $item->update([
                'status'=>1
            ]);
        }
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت بروزرسانی شد');

    }

    public function delete($id)
    {
        Services::find($id)->delete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function render()
    {
        $data=Services::orderBy('order')->paginate($this->paginate_count);
        return view('livewire.dashboard.service.index',compact('data'));
    }

}
