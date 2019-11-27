<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use Faker\Generator as Faker;
use App\Models\Article;
use Illuminate\Support\Facades\DB;

$factory->define(Article::class, function (Faker $faker) {

    
        
    config()->set('database.connections.mysql.strict', false);
    DB::reconnect();
    DB::statement('SET FOREIGN_KEY_CHECKS=0;');

    return [

        'title' => $faker->title,
        'body' => $faker->text,
    ];
    
    DB::statement('SET FOREIGN_KEY_CHECKS=1;');
    config()->set('database.connections.mysql.strict', true);
    DB::reconnect();
    
});
