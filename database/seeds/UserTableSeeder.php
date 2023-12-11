<?php

use Illuminate\Database\Seeder;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'user',
            'username' => 'admin',
            'email' => 'user@admin.com',
            'password' => bcrypt(87654321)
        ]);
    }
}
