<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{

    protected $fillable = ['body'];


    public function user(){

        return $this->belongsTo('App\User');
    }

    public function article(){

        return $this->belongsTo('App\Article');
    }
}
