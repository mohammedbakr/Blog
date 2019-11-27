<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(RolesTableSeeder::class);
        // $this->call(UsersTableSeeder::class);
        
        // factory(App\Models\Article::class,10)->create();
        $this->call(TagsTableSeeder::class);
    }
}
