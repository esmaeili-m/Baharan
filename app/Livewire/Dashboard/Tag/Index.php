<?php

namespace App\Livewire\Dashboard\Tag;

use App\Models\Tags;
use Livewire\Attributes\On;
use Livewire\Component;
use Livewire\WithoutUrlPagination;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination, WithoutUrlPagination;
    protected $paginationTheme = 'bootstrap';
    public $sort,$paginate_count=20;

    public function delete($id)
    {
        Tags::find($id)->delete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    #[On('update_data')]
    public function render()
    {
        $data=Tags::paginate($this->paginate_count);
        return view('livewire.dashboard.tag.index',compact('data'));
    }
}
