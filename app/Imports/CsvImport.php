<?php

namespace App\Imports;

use App\Order;
use Maatwebsite\Excel\Concerns\ToModel;

class CsvImport implements ToModel
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    public function model(array $row)
    {
        //defines data we want to import
        return new Order([
            'name' => $row["name"],
            'email' => $row["email"]
        ]);
    }
}
