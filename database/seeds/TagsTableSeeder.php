<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;

class TagsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('tags')->insert([

            'tag' => 'Fashon',
            'created_at' =>Carbon::now()->format('Y-m-d'),
            'updated_at' =>Carbon::now()->format('Y-m-d'),

        ]);

        DB::table('tags')->insert([

            'tag' => 'Technology',
            'created_at' =>Carbon::now()->format('Y-m-d'),
            'updated_at' =>Carbon::now()->format('Y-m-d'),

        ]);

        DB::table('tags')->insert([

            'tag' => 'Travel',
            'created_at' =>Carbon::now()->format('Y-m-d'),
            'updated_at' =>Carbon::now()->format('Y-m-d'),

        ]);

        DB::table('tags')->insert([

            'tag' => 'Food',
            'created_at' =>Carbon::now()->format('Y-m-d'),
            'updated_at' =>Carbon::now()->format('Y-m-d'),

        ]);

        DB::table('tags')->insert([

            'tag' => 'Photography',
            'created_at' =>Carbon::now()->format('Y-m-d'),
            'updated_at' =>Carbon::now()->format('Y-m-d'),

        ]);
    }
}
