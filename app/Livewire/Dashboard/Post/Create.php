<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Posts;
use App\Models\Tags;
use App\Models\TagsRelations;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $title,$slug,$category_id,$description,$image,$tags=[],$tag_id;
    protected $rules=[
        'title'=>'required',
        'slug' => 'required|unique:posts,slug',
    ];
    protected $messages=[
        'title.required'=>' این فیلد الزامی می باشد',
        'slug.required'=>'این فیلد الزامی می باشد',
        'slug.unique'=>'این عنوان استفاده شده است لطفا عنوان دیگری را وارد کنید',
    ];
    public function save()
    {
        $this->validate();

        $post=Posts::create([
            'title'=>$this->title,
            'slug'=>$this->slug,
            'image'=>$this->image,
            'description'=>$this->description,
            'category_id'=>$this->category_id,
            'order'=>$this->get_order()
        ]);
        foreach ($this->tags as $key => $item){
            TagsRelations::create([
                'tag_id'=>$key,
                'type'=>'post',
                'relation_id'=>$post->id
            ]);
        }
        session()->flash('message','پست با موفقیت ایجاد شد');
        return redirect()->route('post.list');
    }

    public function UpdatedSlug()
    {
        $this->slug=str_replace(' ','-',$this->slug);
    }
    public function UpdatedImage()
    {
        $this->image=upload_file($this->image,'posts');
    }
    public function get_order()
    {
        $max=Posts::max('order');
        return $max == 0 ? $max=1 : $max+1;
    }

    public function UpdatedTagId()
    {
        if (!isset($this->tags[$this->tag_id])){
            $tag_name=Tags::find($this->tag_id);
            $this->tags[$this->tag_id]=$tag_name->title;
        }
    }

    public function remove_tag($key)
    {
        unset($this->tags[$key]);
    }
    public function render()
    {
        return view('livewire.dashboard.post.create');
    }
}
