<?php

namespace App;

use App\Answer;
use App\Question;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function questions()
    {
        # code...
        return $this->hasMany(Question::class);
    }

    public function getUrlAttribute()
    {
        # code...
        return "#";
    }

    public function answers()
    {
        # code...
        return $this->hasMany(Answer::class);
    }

    public function getAvatarAttribute()
    {
        # code...
        $email = $this->email;
        $size = 32;
        return $grav_url = "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?s=" . $size;
    }
}
