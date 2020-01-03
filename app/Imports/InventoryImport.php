<?php

namespace App\Imports;
use App\Basic_Unit;
use DB;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;


class InventoryImport implements ToCollection, WithHeadingRow
{
    /**
    * @param Collection $collection
    */
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $row)
    {

        foreach ($row as $filerow) {
            $total_items = 0;
            $total_cases = 0;
            $total_kits = 0;
            $total_units = 0;

            DB::beginTransaction();
            try {
                if (Basic_Unit::where('sku', trim($filerow['sku']))->doesntExist()) {
                    //dd('DOESNT EXIST', $filerow);
                    $unit = new Basic_Unit();
                    $unit->user_id = $filerow['user_id'];
                    $unit->company = $filerow['company_name'];
                    $unit->sku = $filerow['sku'];
                    $unit->upc = $filerow['upc'];
                    $unit->description = $filerow['description'];
                    $unit->loose_item_qty = $filerow['loose_item_qty'];
                    $unit->basic_unit_qty = $filerow['basic_unit_qty'];
                    $unit->kit_qty = $filerow['kit_qty'];
                    $unit->case_qty = $filerow['case_qty'];
                    $unit->carton_qty = $filerow['carton_qty'];
                    $unit->pallet_qty = $filerow['pallet_qty'];
                    $unit->total_qty = $filerow['total_qty'];
                    $unit->save();
                    //dd($unit);

                }
                else if (Basic_Unit::where('sku', trim($filerow['sku']))->exists()) {
                    $unit = Basic_Unit::where('sku', trim($filerow['sku']))->first();
                    $unit->sku = $filerow['sku'];
                    $unit->upc = $filerow['upc'];
                    $unit->description = $filerow['description'];
                    $unit->loose_item_qty = $filerow['loose_item_qty'];
                    $unit->basic_unit_qty = $filerow['basic_unit_qty'];
                    $unit->kit_qty = $filerow['kit_qty'];
                    $unit->case_qty = $filerow['case_qty'];
                    $unit->carton_qty = $filerow['carton_qty'];
                    $unit->pallet_qty = $filerow['pallet_qty'];
                    $unit->total_qty = $filerow['total_qty'];
                    $unit->save();
                }
                DB::commit();
                return redirect()->back()->with('success', 'You have successfully imported units via CSV.');

            } catch (\Exception $e) {
                DB::rollBack();
                return redirect()->back()->with('error', $e->getMessage());
            }
        }
    }
}
