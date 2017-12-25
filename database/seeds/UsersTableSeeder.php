<?php

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
        \App\User::create([
            'name' => 'Amitav Roy',
            'email' => 'reachme@amitavroy.com',
            'password' => bcrypt('password'),
            'active' => 1,
        ]);

        \App\User::create([
            'name' => 'Jhon Doe',
            'email' => 'jhon.doe@gmail.com',
            'password' => bcrypt('password'),
            'active' => 0,
        ]);
    }
}
