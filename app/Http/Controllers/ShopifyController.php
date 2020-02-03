<?php

namespace App\Http\Controllers;

use App\ShopifyOrder;
use App\Order;
use App\OrderNumber;
use App\Basic_Unit;
use App\Kit;
use App\User;
use Illuminate\Http\Request;
use OhMyBrew\BasicShopifyAPI;
use GuzzleHttp\Exception\GuzzleException;
use GuzzleHttp\Client;
use Illuminate\Support\Str;
use League\Flysystem\Exception;

class ShopifyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        
        $user = User::find($id);
        $user = $user->providers->first()->pivot;

        $shop_name = strval($user->shop_name);
        $api_key = strval($user->api_key);
        $api_pass = strval($user->api_pass);

        $api = new BasicShopifyAPI(true); // true sets it to private
        $api->setVersion('2019-04'); // "YYYY-MM" or "unstable"
        $api->setShop($shop_name);
        $api->setApiKey($api_key);
        $api->setApiPassword($api_pass);
        //This line returns filtered orders from Shopify
        if(Order::where('company', 'Color Proof')->exists()){
            $lastorder = Order::where('company', 'Color Proof')->get()->last();
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
            if(Order::where('cust_order_no', $orders[$i]->order_number)->where('company', 'Color Proof')->exists()){
                
            }
            else{
                
                $shopify_order = new Order();
                $ordernumber = new OrderNumber();
                $user = User::where('company_name', 'Color Proof')->first();
                $ordernumber->save();
                $ordernumber->fss_id = $ordernumber->id + 100;
                $ordernumber->user_id = $user->id;
                $shopify_order->orderid = $ordernumber->fss_id;
                $shopify_order->ordernumber_id = $ordernumber->id;
                $ordernumber->save();

                $shopify_order->cust_order_no = $orders[$i]->order_number;
                $shopify_order->user_id = '129';
                $shopify_order->shopify_id = $orders[$i]->id;
                $shopify_order->company = $user->company_name;
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
                    

                    if (Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->exists()) {
                        $unit = Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->first();
                        $shopify_order->unit_qty +=  $orders[$i]->line_items[$y]->quantity;           
                        $shopify_order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $orders[$i]->line_items[$y]->quantity]]);
            
                    }

                    //dd(gettype($orders[$i]->line_items[$y]->sku));
                    /*
                    
                    if(!(STR::contains($orders[$i]->line_items[$y]->name, ['kit', 'set', 'Kit', 'Set', 'KIT', 'SET']))){
                        if (Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->exists()) {
                            $unit = Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->first();
                            $shopify_order->unit_qty +=  $orders[$i]->line_items[$y]->quantity;           
                            $shopify_order->basic_units()->attach([['basic__unit_id' => $unit->id, 'quantity' => $orders[$i]->line_items[$y]->quantity]]);
                
                        }
                    }
                    */
                    /*
                    if(STR::contains($orders[$i]->line_items[$y]->name, ['kit', 'set', 'Kit', 'Set', 'KIT', 'SET'])){
                        if (Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->exists()) {
                            $kit = Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->first();
                            $shopify_order->kit_qty +=  $orders[$i]->line_items[$y]->quantity;   
                            $shopify_order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $orders[$i]->line_items[$y]->quantity]]);
                        }
                        else{
                            
                            $kit = new Kit();
                            $kit->sku = $orders[$i]->line_items[$y]->sku;
                            $shopify_order->kit_qty +=  $orders[$i]->line_items[$y]->quantity;  
                            $kit->description = $orders[$i]->line_items[$y]->quantity;
                            
                        }
                }
                */
                
                    
                }
                $shopify_order->save();
            }
        }

        //dd($orders);
        //return view('userdash.dash-shopifyorders')->with('orders', $orders);
    }

    public function scanOrders($id){
        $user = User::find($id);
        try{
            $user = $user->providers->first()->pivot;
        }
        catch(\Exception $e){
            return response()->json([
                'error' => 'Error with Shopify API Keys. Please confirm you have the correct information for this user.'
            ], 404);
        }
        
        $shop_name = strval($user->shop_name);
        $api_key = strval($user->api_key);
        $api_pass = strval($user->api_pass);

        
        $api = new BasicShopifyAPI(true); // true sets it to private
        $api->setVersion('2019-04'); // "YYYY-MM" or "unstable"
        $api->setShop($shop_name);
        $api->setApiKey($api_key);
        $api->setApiPassword($api_pass);
        //This line returns filtered orders from Shopify
        if(Order::where('company', 'Color Proof')->exists()){
            $lastorder = Order::where('company', 'Color Proof')->get()->last();
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
            if(Order::where('cust_order_no', $orders[$i]->order_number)->where('company', 'Color Proof')->exists()){
                
            }
            else{
                
                
                for($y = 0; $y < count($orders[$i]->line_items); $y++){
                    
                    //dd(gettype($orders[$i]->line_items[$y]->sku));
                    if(!(STR::contains($orders[$i]->line_items[$y]->name, ['kit', 'set', 'Kit', 'Set', 'KIT', 'SET']))){
                        if (Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->doesntExist()) {
                            //dd($orders[$i]->line_items[$y]->sku);
                            array_push($doesntExist, 'Basic Unit: ' . $orders[$i]->line_items[$y]->sku );                        
                        }

                        else{
                            $unit = Basic_Unit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->first();
                            array_push($exists, 'Basic Unit: ' . $unit->sku );
                        }
                    }

                    if(STR::contains($orders[$i]->line_items[$y]->name, ['kit', 'set', 'Kit', 'Set', 'KIT', 'SET'])){
                        if (Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->doesntExist()) {
                            array_push($doesntExist, 'Kit: ' . $orders[$i]->line_items[$y]->sku );
                            //$kit = Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('user_id', '3')->first();
                            //$shopify_order->kits()->attach([['kit_id' => $kit->id, 'quantity' => $orders[$i]->line_items[$y]->quantity]]);
                        }
                        else{
                            $kit = Kit::where('sku', $orders[$i]->line_items[$y]->sku)->where('company', 'Color Proof')->first();
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
