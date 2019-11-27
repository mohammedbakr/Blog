<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'articles';

    protected $fillable = [

        'title', 'body', 'image',

    ];


    public function user(){

        return $this->belongsTo('App\User');
    }

    public function tags(){

        return $this->belongsToMany('App\Models\Tag');
    }
}
