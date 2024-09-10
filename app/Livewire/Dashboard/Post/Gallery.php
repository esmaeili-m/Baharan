<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\PostsImages;
use Livewire\Component;
use Livewire\WithFileUploads;

class Gallery extends Component
{
    use WithFileUploads;

    public $images=[],$ids;
    public function UpdatedImages()
    {
        foreach ($this->images ?? [] as $item){
            $url=upload_file($item,'galleries/'.$this->ids);
            PostsImages::create([
                'post_id'=>$this->ids,
                'image'=>$url
            ]);
        }
        $this->dispatch('alert',icon:'success',message:'تصاویر با موفقیت اضافه شدند');

    }
    public function delete($id)
    {
        PostsImages::find($id)->delete();
        $this->dispatch('alert',icon:'success',message:'آیتم با موفقیت حذف شد');
    }
    public function mount($id)
    {
        $this->ids=$id;
    }
    public function render()
    {
        $data=PostsImages::where('post_id',$this->ids)->get();
        return view('livewire.dashboard.post.gallery',compact('data'));
    }
}
