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
        User::truncate();
        $userModel = new User();
        $userModel->role_id = 1;
        $userModel->first_name = "Samar";
        $userModel->last_name = "Turabi";
        $userModel->email = "samar@hnh.pk";
        $userModel->username = "samarturabi";
        $userModel->password = '$2y$10$xRdw3jJALAmhN6dWBXBql.c5nx3.nNNre/I/6yhav3.N3tPTvOiBW';
        $userModel->status = "active";
        $userModel->save();
    }
}
