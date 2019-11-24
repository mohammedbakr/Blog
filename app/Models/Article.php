<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{

    protected $table = 'articles';

    protected $fillable = [

        'iamge', 'title', 'body'

    ];


    public function user(){

        return $this->belongsTo('App\User');
    }

    public function categories(){

        return $this->belongsToMany('app\Models\Category');
    }
}
