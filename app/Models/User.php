<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Auth;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];
    public function posts(){
        return $this->hasMany(Post::class);
    }
    public static function sentFriendRequests(){
        // $requests = $this->hasMany(FriendRequest::class,'origin_user','id');
        $requests=FriendRequest::where('origin_user',Auth::user()->id)->where('status','==',0);
        return $requests;
    }
    public static function recivedFriendRequests(){
        // $requests = $this->hasMany(FriendRequest::class,'target_user');
$requests = FriendRequest::where('target_user',Auth::user()->id)->where('status','==',0);
return $requests;
    }
    public static function friends(){
        $friends = Friend::where('user_1',Auth::user()->id)->orWhere('user_2',Auth::user()->id,'user_1');
        return $friends;
    }
}