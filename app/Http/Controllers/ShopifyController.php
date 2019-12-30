<?php

namespace App\Http\Controllers;

use App\ShopifyOrder;
use App\Order;
use App\OrderNumber;
use App\Basic_Unit;
use App\Kit;
use Illuminate\Http\Request;
use OhMyBrew\BasicShopifyAPI;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Str;

class ShopifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        

        $api = new BasicShopifyAPI(true); // true sets it to private
        $api->setVersion('2019-04'); // "YYYY-MM" or "unstable"
        $api->setShop('colorproofhair.myshopify.com');
        $api->setApiKey('0493c9fe78fa2bf98569e3c62c245f30');
        $api->setApiPassword('39c46415113189e15f50e6b32ec1eb0a');
        //This line returns filtered orders from Shopify
        if(Order::where('user_id', '3')->exists()){
            $lastorder = Order::where('user_id', '3')->get()->last();
            $result = $api->rest('get', '/admin/api/2019-10/orders.json', ['limit' => '250', 'status' => 'any', 'since_id' => $lastorder->shopify_id]);
        }
        else{
            $result = $api->rest('get', '/admin/api/2019-10/orders.json', ['limit' => '250', 'status' => 'any', 'fulfillment_status' => 'any']);
        }
        
        
        //$result = $api->rest('get', '/admin/api/2019-10/orders.json', ['limit' => '250', 'status' => 'open', 'fulfillment_status' => 'unshipped', 'financial_status' => 'paid']);
        //dd($result->body->product->vendor);
        //dd($result->body->orders);
        $orders = $result->body->orders;
        //dd($orders);
        
        /*
        for($i = 0; $i < count($orders[0]->line_items); $i++){
            print_r($orders[0]->line_items[$i]);
            echo '<br/>';
            
            echo '<br/>';
        }
        */

        for($i = 0; $i < count($orders); $i++){
            //dd($orders[$i]);
            if(Order::where('cust_order_no', $orders[$i]->order_number)->where('user_id', '3')->exists()){
                
            }
            else{
                
                $shopify_order = new Order();
                $ordernumber = new OrderNumber();
                $ordernumber->save();
                $ordernumber->fss_id = $ordernumber->id + 100;
                $ordernumber->user_id = '3';
                $shopify_order->orderid = $ordernumber->fss_id;
                $shopify_order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();

                $shopify_order->cust_order_no = $orders[$i]->order_number;
                $shopify_order->user_id = '3';
                $shopify_order->shopify_id = $orders[$i]->id;
                $shopify_order->company = auth()->user()->company_name;
                $shopify_order->cust_name = ucwords($orders[$i]->customer->first_name . ' ' . $orders[$i]->customer->last_name);
                $shopify_order->street_address = ucwords($orders[$i]->shipping_address->address1 . ' ' . $orders[$i]->shipping_address->address2);
                $shopify_order->city = ucwords($orders[$i]->shipping_address->city);
                $shopify_order->state = ucwords($orders[$i]->shipping_address->province);
                $shopify_order->zip = ucwords($orders[$i]->shipping_address->zip);
                if($orders[$i]->fulfillment_status == null){
                    $shopify_order->fulfillment_status = 'Unfulfilled';
                }
                else{
                    $shopify_order->fulfillment_status = ucwords($orders[$i]->fulfillment_status);
                }
                $shopify_order->financial_status = ucwords($orders[$i]->financial_status);
                $shopify_order->order_type = 'Fulfill Items';
                $shopify_order->status = 'Pending Approval';
                $shopify_order->save();
                for($y = 0; $y < count($orders[$i]->line_items); $y++){
                    
                    //dd(gettype($orders[$i]->line_items[$y]->sku));

                    if (Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->exists()) {
                        //dd($orders[$i]->line_items[$y]->sku);
                        
                        $unit = Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->first();
                        
                        $shopify_order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $orders[$i]->line_items[$y]->quantity]]);
                        
                        
                    }
                    /*
                    if (Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->exists()) {
                        
                        $kit = Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->first();
                        $shopify_order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $orders[$i]->line_items[$y]->quantity]]);
                    }
                    */
                }

            }
        }
        /*
        for($i = 0; $i < count($orders[0]->line_items); $i++){
            dd($orders[0]->line_items[$i]);
            echo '<br/>';
            
            echo '<br/>';
        }
        */
        
        
        //dd($orders);
        //return view('userdash.dash-shopifyorders')->with('orders', $orders);
    }

    public function scanOrders(){
        $api = new BasicShopifyAPI(true); // true sets it to private
        $api->setVersion('2019-04'); // "YYYY-MM" or "unstable"
        $api->setShop('colorproofhair.myshopify.com');
        $api->setApiKey('0493c9fe78fa2bf98569e3c62c245f30');
        $api->setApiPassword('39c46415113189e15f50e6b32ec1eb0a');
        //This line returns filtered orders from Shopify
        if(Order::where('user_id', '3')->exists()){
            $lastorder = Order::where('user_id', '3')->get()->last();
            $result = $api->rest('get', '/admin/api/2019-10/orders.json', ['limit' => '250', 'status' => 'any', 'since_id' => $lastorder->shopify_id]);
        }
        else{
            $result = $api->rest('get', '/admin/api/2019-10/orders.json', ['limit' => '250', 'status' => 'any', 'fulfillment_status' => 'any']);
        }
        
        
        //$result = $api->rest('get', '/admin/api/2019-10/orders.json', ['limit' => '250', 'status' => 'open', 'fulfillment_status' => 'unshipped', 'financial_status' => 'paid']);
        //dd($result->body->product->vendor);
        //dd($result->body->orders);
        $orders = $result->body->orders;
        //dd($orders);
        
        /*
        for($i = 0; $i < count($orders[0]->line_items); $i++){
            print_r($orders[0]->line_items[$i]);
            echo '<br/>';
            
            echo '<br/>';
        }
        */

        $doesntExist = array();
        $exists = array();

        for($i = 0; $i < count($orders); $i++){
            //dd($orders[$i]);
            if(Order::where('cust_order_no', $orders[$i]->order_number)->where('user_id', '3')->exists()){
                
            }
            else{
                
                
                for($y = 0; $y < count($orders[$i]->line_items); $y++){
                    
                    //dd(gettype($orders[$i]->line_items[$y]->sku));
                    if(!(STR::contains($orders[$i]->line_items[$y]->name, ['kit', 'set', 'Kit', 'Set']))){
                        if (Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->doesntExist()) {
                            //dd($orders[$i]->line_items[$y]->sku);
                            array_push($doesntExist, 'Basic Unit: ' . $orders[$i]->line_items[$y]->sku );                        
                        }

                        else{
                            $unit = Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->first();
                            array_push($exists, 'Basic Unit: ' . $unit->sku );
                        }
                    }

                    if(STR::contains($orders[$i]->line_items[$y]->name, ['kit', 'set', 'Kit', 'Set'])){
                        if (Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->doesntExist()) {
                            array_push($doesntExist, 'Kit: ' . $orders[$i]->line_items[$y]->sku );
                            //$kit = Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->first();
                            //$shopify_order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $orders[$i]->line_items[$y]->quantity]]);
                        }
                        else{
                            $kit = Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->first();
                            array_push($exists, 'Kit: ' . $kit->sku );
                        }
                    }

                    
                }

            }
        }  
        return response()->json([
            'success'  => 'Shopify Orders scanned successfully.',
            'doesntExist' => $doesntExist,
            'exists' => $exists
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
