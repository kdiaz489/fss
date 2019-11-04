<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    protected $table = 'orders_history';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamp
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }

    
}
