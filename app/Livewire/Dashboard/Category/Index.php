<?php

namespace App\Livewire\Dashboard\Category;

use App\Models\Category;
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
            Category::find($item)->update([
                'order' => $counter
            ]);
            $counter++;
        }
        $this->sort = [];
    }
    public function change_status($id)
    {
        $item=Category::find($id);
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
        Category::find($id)->delete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }


    public function render()
    {
        $data=Category::with('category_parent')->orderBy('order')->paginate($this->paginate_count);
        return view('livewire.dashboard.category.index',compact('data'));
    }
}
