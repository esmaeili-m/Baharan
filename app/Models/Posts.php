<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Posts extends Model
{
    use HasFactory,SoftDeletes;
    protected $guarded=[];

    public function tags()
    {
        return $this->belongsToMany(Tags::class, TagsRelations::class, 'relation_id', 'tag_id')->where('type','post');
    }
}
