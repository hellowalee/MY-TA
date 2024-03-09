<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
         $users = [
            [
                'id'             => 1,
                'name'           => 'admin',
                'email'           => 'fiansyahmm@gmail.com',
                'email_verified_at' => null,
                'password'       => bcrypt('arif1234'),
                'isAdmin'        => 1,
                'remember_token' => null,
            ],
             
        ];

        User::insert($users);

    }
}
