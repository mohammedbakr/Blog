<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Role;
use Illuminate\Support\Facades\DB;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        User::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        DB::table('role_user')->truncate();


        $adminRole = Role::where('name', 'admin')->first();
        $authorRole = Role::where('name', 'author')->first();
        $userRole = Role::where('name', 'user')->first();

        $admin = User::create([
            'name' => 'admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);

        $author = User::create([
            'name' => 'author',
            'email' => 'author@author.com',
            'password' => bcrypt('author')
        ]);

        $user = User::create([
            'name' => 'user',
            'email' => 'user@user.com',
            'password' => bcrypt('user')
        ]);

        $admin->roles()->attach($adminRole);
        $author->roles()->attach($authorRole);
        $user->roles()->attach($userRole);

        // fake users for testing
        factory(App\User::class, 5)->create();
    }
}
