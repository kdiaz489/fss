<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $table = 'orders';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamp
    public $timestamps = true;

    public function user(){
        return $this->belongsTo('App\User');
    }
    
    public function ordernumber(){
        return $this->belongsTo('App\OrderNumber')->withTimestamps();
    }

    public function pallets(){
        return $this->belongsToMany('App\Pallet')->withPivot('quantity')->withTimestamps();
    }

    public function kits(){
        return $this->belongsToMany('App\Kit')->withPivot('quantity')->withTimestamps();
    }

    public function cases(){
        return $this->belongsToMany('App\Cases')->withPivot('quantity')->withTimestamps();
    }
    public function basic_units(){
       return $this->belongsToMany('App\Basic_Unit')->withPivot('quantity')->withTimestamps();
    }
}
