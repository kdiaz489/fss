<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $table = 'kit_tbl';

    public $primaryKey = 'id';

    protected $fillable = ['sku', 'upc', 'description', 'loose_item_qty', 'basic_unit_qty', 'kit_qty', 'case_qty', 'carton_qty', 'pallet_qty', 'total_qty', 'location', 'lot_num'];


    public function user(){
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }

    public function basic_units(){
        return $this->belongsToMany('App\Basic_Unit')->withPivot('quantity')->withTimestamps();
    }

    public function cases(){
        return $this->belongsToMany('App\Cases')->withPivot('quantity')->withTimestamps();
    }

    public function cartons(){
        return $this->belongsToMany('App\Cartons')->withPivot('quantity')->withTimestamps();
    }

    public function pallets(){
        return $this->belongsToMany('App\Pallet')->withPivot('quantity')->withTimestamps();
    }

    public function orders(){
        return $this->belongsToMany('App\Order')->withPivot('quantity')->withTimestamps();
    }
}
