<?php

namespace App\Livewire\Dashboard\Article;

use App\Models\Article;
use App\Models\Tags;
use App\Models\TagsRelations;
use Livewire\Component;
use Livewire\WithFileUploads;

class Update extends Component
{
    use WithFileUploads;
    public $item,$title,$slug,$description,$image,$tags=[],$tag_id;
    public function rules()
    {
        return [
            'title' => 'required',
            'slug' => 'required|unique:articles,slug,' . $this->item->id,
        ];
    }
    protected $messages=[
        'title.required'=>' این فیلد الزامی می باشد',
        'slug.required'=>'این فیلد الزامی می باشد',
        'slug.unique'=>'این عنوان استفاده شده است لطفا عنوان دیگری را وارد کنید',
    ];

    public function mount($id)
    {
        $this->item=Article::with('tags')->find($id);
        $this->fill([
            'title'=>$this->item->title,
            'slug'=>$this->item->slug,
            'description'=>$this->item->description,
            'image'=>$this->item->image,
            'tags'=>$this->item->tags->pluck('title','id')
        ]);
    }
    public function save()
    {
        $this->validate();
        $this->item->update([
            'title'=>$this->title,
            'slug'=>$this->slug,
            'image'=>$this->image,
            'description'=>$this->description,
        ]);
        TagsRelations::where('type','article')->where('relation_id',$this->item->id)->delete();
        foreach ($this->tags as $key => $item){
            TagsRelations::create([
                'tag_id'=>$key,
                'type'=>'article',
                'relation_id'=>$this->item->id
            ]);
        }
        session()->flash('message','مقاله با موفقیت آپدیت شد');
        return redirect()->route('article.list');
    }
    public function UpdatedSlug()
    {
        $this->slug=str_replace(' ','-',$this->slug);
    }
    public function UpdatedImage()
    {
        $this->image=upload_file($this->image,'articles');
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
        return view('livewire.dashboard.article.update');
    }
}
