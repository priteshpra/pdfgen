<?php

namespace Database\Seeders;

use App\Models\User;
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
            'FirstName' => 'Admin',
            'Email' => 'admin@admin.com',
            'password' => bcrypt('secret'),
            'role_id' => '1'
        ]);

        User::create([
            'FirstName' => 'User',
            'Email' => 'user@user.com',
            'password' => bcrypt('secret'),
            'role_id' => '2'
        ]);
    }
}
