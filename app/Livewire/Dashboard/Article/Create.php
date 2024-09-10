<?php

namespace App\Livewire\Dashboard\Article;

use App\Models\Article;
use App\Models\Tags;
use App\Models\TagsRelations;
use Livewire\Component;
use Livewire\WithFileUploads;

class Create extends Component
{
    use WithFileUploads;
    public $title,$slug,$description,$image,$tags=[],$tag_id;
    protected $rules=[
        'title'=>'required',
        'slug' => 'required|unique:articles,slug',
    ];
    protected $messages=[
        'title.required'=>' این فیلد الزامی می باشد',
        'slug.required'=>'این فیلد الزامی می باشد',
        'slug.unique'=>'این عنوان استفاده شده است لطفا عنوان دیگری را وارد کنید',
    ];
    public function save()
    {
        $this->validate();

        $article=Article::create([
            'title'=>$this->title,
            'slug'=>$this->slug,
            'image'=>$this->image,
            'description'=>$this->description,
            'order'=>$this->get_order()
        ]);
        foreach ($this->tags as $key => $item){
            TagsRelations::create([
                'tag_id'=>$key,
                'type'=>'article',
                'relation_id'=>$article->id
            ]);
        }
        session()->flash('message','مقاله با موفقیت ایجاد شد');
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
    public function get_order()
    {
        $max=Article::max('order');
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
        return view('livewire.dashboard.article.create');
    }
}
