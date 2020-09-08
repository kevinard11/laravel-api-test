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
        return route("questions.show", $this->slug);
    }

    public function getCreatedDateAttribute()
    {
        # code...
        return $this->created_at->diffForHumans();
    }

    public function getStatusAttribute()
    {
        # code...
        if($this->answers > 0){ 
            if($this->best_answer_id){
                return "answered-accepted";
            }
            return "answered";
        }
        return "unanswered";
    }

    public function getBodyHtmlAttribute()
    {
        # code... 
        // $parsedown = new \Parsedown();
        return \Parsedown::instance()->text($this->body);
    }
}
