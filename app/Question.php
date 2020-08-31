<?php

namespace App;

use App\User;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
    //
    protected $fillable = [
        'title','body'
    ];
    public function user()
    {
        # code...
        return $this->belongsTo(User::class);
    }

    public function setTitleAttribute($value)
    {
        # code...
        $this->attributes['title']= $value;
        $this->attributes['slug']= Str::slug($value);
        
    }

    public function getUrlAttribute()
    {
        # code...
        return route("questions.show", $this->id);
    }

    public function getCreatedDateAttribute()
    {
        # code...
        return $this->created_at->diffForHumans();
    }
}
