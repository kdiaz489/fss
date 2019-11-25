<?php

namespace App\Imports;

use DB;
use App\Order;
use App\OrderNumber;
use App\Basic_Unit;
use App\Kit;
use App\Cases;
use Maatwebsite\Excel\Concerns\ToModel;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\ToCollection;
use Maatwebsite\Excel\Concerns\WithHeadingRow;

class CsvImport implements ToCollection, WithHeadingRow
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function collection(Collection $row)
    {
        //defines data we want to import
        $prev_order_no = '';

        foreach ($row as $orderrow) {
            //dd($orderrow);
            $total_items = 0;
            $total_cases = 0;
            $total_kits = 0;
            $total_units = 0;

            DB::beginTransaction();
            try {
                if (Order::where('cust_order_no', ltrim($orderrow['name'], '#'))->doesntExist()) {
                    //dd($orderrow, 'doesnt exist');
                    /*return new Order([
                        'cust_order_no' => $row["email"]
                    ]); */

                    $order = new Order();
                    $ordernumber = new OrderNumber();
                    $ordernumber->save();
                    $ordernumber->fss_id = $ordernumber->id + 100;
                    $ordernumber->user_id = auth()->user()->id;
                    $order->orderid = $ordernumber->fss_id;
                    $order->ordernumber_id = $ordernumber->id;
                    $ordernumber->save();


                    $order->user_id = auth()->user()->id;
                    $order->company = auth()->user()->company_name;
                    $order->order_type = 'Fulfill Items';
                    $order->cust_name = $orderrow['shipping_name'];
                    $order->cust_order_no = ltrim($orderrow['name'], '#');
                    $order->street_address = $orderrow['shipping_address1'] . $orderrow['shipping_address2'];
                    $order->city = $orderrow['shipping_city'];
                    $order->zip = $orderrow['shipping_zip'];
                    $order->status = 'Pending Approval';
                    $order->save();



                    $item_qty = $orderrow['lineitem_quantity'];

                    if (Basic_Unit::where('sku', trim($orderrow['lineitem_sku']))->exists()) {

                        $total_items += $item_qty;
                        $total_units += $item_qty;
                        $unit = Basic_Unit::where('sku', trim($orderrow['lineitem_sku']))->first();
                        //
                        //dd($unit);
                        if ($unit->total_qty < $item_qty) {
                            throw new \Exception('Quantity of units in order is greater than quantity at hand.');
                        }
                        $order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty]]);
                    }

                    if (Kit::where('sku', trim($orderrow['lineitem_sku']))->exists()) {
                        $total_items += $item_qty;
                        $total_units += $item_qty;
                        $kit = Kit::find(trim($orderrow['lineitem_sku']));
                        if ($kit->total_qty < $item_qty) {
                            throw new \Exception('Quantity of kits in order is greater than quantity at hand.');
                        }
                        $order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty]]);
                    }

                    if (Cases::where('sku', trim($orderrow['lineitem_sku']))->exists()) {
                        $total_items += $item_qty;
                        $total_units += $item_qty;
                        $case = Cases::find(trim($orderrow['lineitem_sku']));
                        if ($case->total_qty < $item_qty) {
                            throw new \Exception('Quantity of cases in order is greater than quantity at hand.');
                        }
                        $order->cases()->attach([['cases_id' => $unit->id, 'quantity' => $item_qty]]);
                    }
                    $order->case_qty = $total_cases;
                    $order->kit_qty = $total_kits;
                    $order->unit_qty = $total_units;
                    $order->tot_qty = $total_items;
                    $order->save();
                    //$prev_order_no = $orderrow['Name'];

                } else if (Order::where('cust_order_no', trim($orderrow['name'], '#'))->exists()) {
                    //dd($orderrow, 'exists');
                    $order = Order::where('cust_order_no', trim($orderrow['name'], '#'))->first();
                    $item_qty = $orderrow['lineitem_quantity'];
                    if (Basic_Unit::where('sku', trim($orderrow['lineitem_sku']))->exists()) {
                        //$total_items += $item_qty;
                        //$total_units += $item_qty;

                        $order->unit_qty += $item_qty;
                        $order->tot_qty += $item_qty;
                        $unit = Basic_Unit::where('sku', trim($orderrow['lineitem_sku']))->first();

                        if ($unit->total_qty < $item_qty) {
                            throw new \Exception('Quantity of units in order is greater than quantity at hand.');
                        }
                        $order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $item_qty]]);
                    }

                    if (Kit::where('sku', trim($orderrow['lineitem_sku']))->exists()) {
                        //$total_items += $item_qty;
                        //$total_units += $item_qty;
                        $order->kit_qty += $item_qty;
                        $order->tot_qty += $item_qty;
                        $kit = Kit::where('sku', trim($orderrow['lineitem_sku']))->first();
                        if ($kit->total_qty < $item_qty) {
                            throw new \Exception('Quantity of kits in order is greater than quantity at hand.');
                        }
                        $order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $item_qty]]);
                    }

                    if (Cases::where('sku', trim($orderrow['lineitem_sku']))->exists()) {
                        //$total_items += $item_qty;
                        //$total_units += $item_qty;
                        $order->case_qty += $item_qty;
                        $order->tot_qty += $item_qty;
                        $case = Cases::where('sku', trim($orderrow['lineitem_sku']))->first();
                        if ($case->total_qty < $item_qty) {
                            throw new \Exception('Quantity of cases in order is greater than quantity at hand.');
                        }
                        $order->cases()->attach([['cases_id' => $unit->id, 'quantity' => $item_qty]]);
                    }
                    $order->case_qty += $total_cases;
                    $order->kit_qty += $total_kits;
                    $order->unit_qty += $total_units;
                    $order->tot_qty += $total_items;
                    $order->save();
                }
            } catch (\Exception $e) {
                DB::rollBack();
                return redirect('/createfilorder')->with('error', $e->getMessage());
            }
        }
        return redirect('/createfilorder')->with('success', 'success');
    }

    /*
    return new Order([
        'cust_order_no' => $row["email"]
    ]);
    */
}
