<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderNumber extends Model
{
    protected $table = 'order_number';

    public $primaryKey = 'id';

    public function user(){
        return $this->belongsTo('App\User');
    }

    public function order(){
        return $this->hasOne('App\Order');
    }

}
