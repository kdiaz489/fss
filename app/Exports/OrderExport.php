<?php

namespace App\Exports;

use App\Order;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class OrderExport implements FromQuery, WithHeadings
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
        $order = Order::where('user_id', '=', $this->id);
        return $order;
    }

    public function headings(): array{
        return [
            'id',
            'ordernumber_id',
            'financial_status',
            'fulfillment_status',
            'order_id',
            'user_id',
            'shopify_id',
            'company',
            'originator',
            'in_care_of',
            'so_num',
            'po_num',
            'job_num',
            'carrier_id',
            'carrier',
            'name',
            'cust_name',
            'cust_order_no',
            'street_address',
            'city',
            'state',
            'zip',
            'order_type',
            'barcode',
            'description',
            'unit_qty',
            'kit_qty',
            'case_qty',
            'carton_qty',
            'pallet_qty',
            'tot_qty',
            'status',
            'created_at',
            'updated_at',
        ];
    }
}
