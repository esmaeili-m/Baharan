<?php

namespace App\Livewire\Dashboard\Post;

use App\Models\Posts;
use App\Models\Tags;
use App\Models\TagsRelations;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $post,$title,$slug,$category_id,$description,$image,$tags=[],$tag_id;
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:posts,slug,' . $this->post->id,
        ];
    }
    protected $messages=[
        'title.required'=>' این فیلد الزامی می باشد',
        'slug.required'=>'این فیلد الزامی می باشد',
        'slug.unique'=>'این عنوان استفاده شده است لطفا عنوان دیگری را وارد کنید',
    ];

    public function mount($id)
    {
        $this->post=Posts::with('tags')->find($id);
        $this->fill([
            'title'=>$this->post->title,
            'slug'=>$this->post->slug,
            'description'=>$this->post->description,
            'category_id'=>$this->post->category_id,
            'image'=>$this->post->image,
            'tags'=>$this->post->tags->pluck('title','id')
        ]);
    }
    public function save()
    {
        $this->validate();
        $this->post->update([
            'title'=>$this->title,
            'slug'=>$this->slug,
            'image'=>$this->image,
            'description'=>$this->description,
            'category_id'=>$this->category_id,
        ]);
        TagsRelations::where('type','post')->where('relation_id',$this->post->id)->delete();
        foreach ($this->tags as $key => $item){
            TagsRelations::create([
                'tag_id'=>$key,
                'type'=>'post',
                'relation_id'=>$this->post->id
            ]);
        }
        session()->flash('message','پست با موفقیت آپدیت شد');
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
        return view('livewire.dashboard.post.update');
    }
}
