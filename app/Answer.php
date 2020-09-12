<?php

namespace App;

use App\User;
use App\Question;
use Illuminate\Database\Eloquent\Model;

class Answer extends Model
{
    //
    public function question()
    {
        # code...
        return $this->belongsTo(Question::class);
    }

    public function user()
    {
        # code...
        return $this->belongsTo(User::class);
    }

    public static function boot()
    {
        # code...
        parent::boot();

        static::created(function($answer){
            $answer->question->increment('answers_count');
        });
    }

    public function getCreatedDateAttribute()
    {
        # code...
        return $this->created_at->diffForHumans();
    }
}
