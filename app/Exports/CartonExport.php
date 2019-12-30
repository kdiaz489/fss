<?php

namespace App\Exports;

use App\Carton;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class CartonExport implements FromQuery, WithHeadings
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
        $order = Carton::where('user_id', '=', $this->id);
        return $order;
    }

    public function headings(): array{
        return [
            'id',
            'user_id',
            'company',
            'pallet_qty',
            'sku',
            'status',
            'upc',
            'barcode',
            'description',
            'total_qty',
            'created_at',
            'updated_at',
        ];
    }
}
