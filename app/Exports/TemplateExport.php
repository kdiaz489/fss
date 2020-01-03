<?php

namespace App\Exports;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\Exportable;


class TemplateExport implements FromCollection, WithHeadings
{

    use Exportable;

    public function __construct(Collection $user){
        $this->user = $user;
    }

    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        //
        $csv_data = $this->user;
        return $csv_data;
    }

    public function headings(): array{
        return [
            'user_id',
            'company_name',
            'sku',
            'upc',
            'description',
            'loose_item_qty',
            'basic_unit_qty',
            'kit_qty',
            'case_qty',
            'carton_qty',
            'pallet_qty',
            'total_qty',
        ];
    }
    
}
