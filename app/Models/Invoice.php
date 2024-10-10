<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invoice extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $casts = [
      'products'=>'array'
    ];

    public function user()
    {
        return $this->hasOne(User::class,'id','user_id');
    }
}
