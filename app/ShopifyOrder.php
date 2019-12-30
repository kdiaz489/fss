<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShopifyOrder extends Model
{
    protected $table = 'shopify_orders';

    public $primaryKey = 'id';
    
    public function user(){
        // Order has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }
}
