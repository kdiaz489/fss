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
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }

    public function kits(){
        return $this->belongsToMany('App\Kit')->withTimestamps();
    }

    public function basic_units(){
       return $this->belongsToMany('App\Basic_Unit')->withTimestamps();
    }
}
