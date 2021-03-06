<?php

namespace App;

use App\Mail\UserWelcomeMail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Mail;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','username'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
protected static function boot(){
    parent::boot();

    static::created(function ($user){
        $user->profile()->create([
            'title'=>$user->username,
        ]);
        Mail::to($user->email)->send(new UserWelcomeMail());
    });



}
    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function following()
    {
        return $this->belongsToMany(\App\Profile::class);
    }
    public function Profile(){
      return  $this->hasOne(\App\Profile::class);
    }

    public function posts()
    {
        return $this->hasMany(\App\Post::class)->orderBy('created_at','DESC');
    }
    public function getRouteKeyName()
    {
        return 'username'; //this will return user name as route
    }
}
