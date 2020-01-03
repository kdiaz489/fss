<?php

namespace App\Exports;

use App\Basic_Unit;
use App\Kit;
use App\Cases;
use PhpOffice\PhpSpreadsheet\Cell\Cell;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use PhpOffice\PhpSpreadsheet\Cell\DefaultValueBinder;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use PhpOffice\PhpSpreadsheet\Cell\DataType;
use Maatwebsite\Excel\Concerns\WithCustomValueBinder;





class InventoryExport extends DefaultValueBinder implements FromCollection, WithHeadings, WithMapping, ShouldAutoSize, WithCustomValueBinder 
{

    use Exportable;

    public function __construct(string $id){
        $this->id = $id;
    }
    
    /**
    * @return \Illuminate\Support\Collection
    */
    public function collection()
    {
        $units = Basic_Unit::where('user_id', '=', $this->id)->get();
        $kits = Kit::where('user_id', '=', $this->id)->get();
        $cases = Cases::where('user_id', '=', $this->id)->get();
        $inventory = collect();
        $inventory = $inventory->merge($units)->merge($kits);
        return $inventory;
    }

    public function bindValue(Cell $cell, $value)
    {
        if (is_numeric($value)) {
            $cell->setValueExplicit($value, DataType::TYPE_STRING);
            return true;
        }

        // else return default behavior
        return parent::bindValue($cell, $value);
    }

    public function map($row): array{
        return $fields = [
            $row->sku,
            $row->upc,
            $row->description,
            $row->loose_item_qty,
            $row->kit_qty,
            $row->case_qty,
            $row->carton_qty,
            $row->pallet_qty,
            $row->total_qty,
        ];
    }


    public function headings(): array{
        return [
            'sku',
            'upc',
            'description',
            'loose_item_qty',
            'kit_qty',
            'case_qty',
            'carton_qty',
            'pallet_qty',
            'total_qty',
        ];
    }

}
