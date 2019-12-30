<?php

namespace App\Exports;

use App\Cases;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CaseExport implements FromQuery, WithHeadings
{

    use Exportable;

    public function __construct(string $id){
        $this->id = $id;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function query()
    {
        $order = Cases::where('user_id', '=', $this->id);
        return $order;
    }

    public function headings(): array{
        return [
            'id',
            'user_id',
            'company',
            'sku',
            'upc',
            'description',
            'basic_unit_qty',
            'kit_qty',
            'case_qty',
            'carton_qty',
            'pallet_qty',
            'total_qty',
            'created_at',
            'updated_at',
        ];
    }
}
