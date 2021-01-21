<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;

class Users extends Seeder
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
                "role_id" => 1, // admin
                "first_name" => "Super",
                "last_name" => "Admin",
                "username" => "superadmin",
                "email" => "admin@hnh.pk",
                "password" => '$2y$10$xRdw3jJALAmhN6dWBXBql.c5nx3.nNNre/I/6yhav3.N3tPTvOiBW', // 123456
                "status" => "active"
            ],
            [
                "role_id" => 2, // colette
                "first_name" => "Colette",
                "last_name" => "Hospital",
                "username" => "colettehospital",
                "email" => "colette@hnh.pk",
                "password" => '$2y$10$xRdw3jJALAmhN6dWBXBql.c5nx3.nNNre/I/6yhav3.N3tPTvOiBW', // 123456
                "status" => "active"
            ]
        ];
        User::truncate();
        foreach($users as $user){
            $userModel = new User();
            $userModel->name = $user;
            $userModel->save();
        }
    }
}
