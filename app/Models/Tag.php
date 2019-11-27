<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{

    protected $table = 'tags';
    
    protected $fillable = [

        'tag'
    
    ];


    public function articles(){

        return $this->belongsToMany('App\Models\Article');
    }
}
