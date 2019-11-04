<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Basic_Unit extends Model
{
    protected $table = 'basic_unit_tbl';

    public $primaryKey = 'id';

    

    public function user(){
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }

    public function kits(){
        return $this->belongsToMany('App\Kit')->withPivot('quantity')->withTimestamps();
    }

    public function cases(){
        return $this->belongsToMany('App\Cases')->withPivot('quantity')->withTimestamps();
    }

    public function pallets(){
        return $this->belongsToMany('App\Pallet')->withPivot('quantity')->withTimestamps();
    }

    public function orders(){
        return $this->belongsToMany('App\Order')->withPivot('quantity')->withTimestamps();
    }
}
