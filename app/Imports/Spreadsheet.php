<?php

namespace App\Imports;

use App\Models\Spreadsheet as Sheet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class Spreadsheet implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row['amount_in']) && !empty($row['description_in']) && !empty($row['category_in'])){
            return new Sheet([
                //
                'user_id' => auth()->user()->id,
                'type' => 'in',
                'date' => (\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_in']))->format('Y-m-d'),
                'amount' => $row['amount_in'],
                'description' => $row['description_in'],
                'category' => $row['category_in'],
            ]);
        }
        return;
    }
}
