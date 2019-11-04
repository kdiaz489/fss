<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Pallet extends Model
{
    protected $table = 'pallets';

    public $primaryKey = 'id';

    

    public function user(){
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }

    public function basic_units(){
        return $this->belongsToMany('App\Basic_Unit')->withPivot('quantity')->withTimestamps();
    }

    public function kits(){
        return $this->belongsToMany('App\Kit')->withPivot('quantity')->withTimestamps();
    }

    public function cases(){
        return $this->belongsToMany('App\Cases')->withPivot('quantity')->withTimeStamps();
    }

    public function orders(){
        return $this->belongsToMany('App\Order')->withPivot('quantity')->withTimestamps();
    }

}
