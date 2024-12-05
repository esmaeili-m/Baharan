<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Chat extends Model
{
    use HasFactory;
    protected $guarded=[];

    public function messages()
    {
        return $this->hasMany(Message::class,'chat_id','id');
    }


    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');

    }
    public function messages_seen()
    {
        return $this->hasMany(Message::class,'chat_id','id')
            ->where('seen',0)
            ->whereNot('sender_id',Auth::user()->id);
    }

}
