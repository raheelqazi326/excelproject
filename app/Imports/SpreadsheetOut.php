<?php

namespace App\Imports;

use App\Models\Spreadsheet as Sheet;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class SpreadsheetOut implements ToModel, WithHeadingRow
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        if(!empty($row['amount_out']) && !empty($row['description_out']) && !empty($row['category_out'])){
            return new Sheet([
                //
                'user_id' => auth()->user()->id,
                'type' => 'out',
                'date' => (\PhpOffice\PhpSpreadsheet\Shared\Date::excelToDateTimeObject($row['date_out']))->format('Y-m-d'),
                'amount' => $row['amount_out'],
                'description' => $row['description_out'],
                'category' => $row['category_out']
            ]);
        }
        return;
    }
}
