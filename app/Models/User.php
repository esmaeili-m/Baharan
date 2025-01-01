<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable,SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'code_meli',
        'father',
        'birthday',
        'address',
        'type',
        'license_number',
        'license_date',
        'license_image',
        'phone',
        'token',
        'status',
        'description',
        'avatar',
        'role_id',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function role()
    {
        return $this->hasOne(Role::class,'id','role_id');
    }



    public function hasPermission($permission)
    {
        return $this->role->permissions->contains('name', $permission);
    }

    public function chats()
    {
        return $this->hasMany(Chat::class,'user_id','id')->with('messages');
    }
    public static function generateUniqueToken()
    {
        do {
            $token = Str::random(60);
        } while (User::where('token', $token)->exists());
        return $token;
    }

    public function transaction()
    {
        return $this->hasOne(Transaction::class,'user_id','id')->whereNotNull('description');

    }
}
