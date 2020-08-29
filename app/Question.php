<?php

namespace App;

use App\User;
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

}
