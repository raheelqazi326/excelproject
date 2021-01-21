<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class Roles extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $roles = [
            1 => "admin",
            2 => "colette",
            3 => "user"
        ];
        Role::truncate();
        foreach($roles as $key => $role){
            $roleModel = new Role();
            $roleModel->name = $key;
            $roleModel->name = $role;
            $roleModel->save();
        }
    }
}
