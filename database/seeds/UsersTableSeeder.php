<?php

use App\Entities\Users\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name'     => 'Administrator',
            'username' => 'admin',
            'email'    => 'admin@example.net',
            'role_id'  => 1,
            'password' => bcrypt('password'),
        ]);
    }
}
