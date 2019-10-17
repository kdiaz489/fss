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
        return $this->belongsToMany('App\Kit')->withTimestamps();
    }

    public function orders(){
        return $this->belongsToMany('App\Order')->withTimestamps();
    }
}
