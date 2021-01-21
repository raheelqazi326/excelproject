<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Status;

class Statuses extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $statuses = [
            1 => "pending",
            2 => "waiting for response",
            3 => "approved",
            4 => "reject"
        ];
        Status::truncate();
        foreach($statuses as $key => $status){
            $statusModel = new Status();
            $statusModel->id = $key;
            $statusModel->name = $status;
            $statusModel->save();
        }
    }
}
