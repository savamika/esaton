<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DummyUsersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $userData = [
            [
                "firstname" => "Admin",
                "lastname" => "Admin",
                "email" => "admin@mail.com",
                "password" => Hash::make('1234'),
                "role" => "admin",
            ],
            [
                "firstname" => "visitor",
                "lastname" => "visitor",
                "email" => "visitor@mail.com",
                "password" => Hash::make('1234'),
                "role" => "visitor",
            ]
        ];

        foreach($userData as $key => $val){
            User::create($val);
        }
    }
}
