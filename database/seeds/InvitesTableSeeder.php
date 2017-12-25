<?php

use Illuminate\Database\Seeder;

class InvitesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(\App\Models\Invite::class)->create([
            'email' => 'no-reply@test.com',
            'user_id' => 1,
        ]);

        factory(\App\Models\Invite::class)->create([
            'email' => 'no-reply@test.co',
            'user_id' => 1,
        ]);
    }
}
