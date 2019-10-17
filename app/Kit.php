<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Kit extends Model
{
    protected $table = 'kit_tbl';

    public $primaryKey = 'id';

    

    public function user(){
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }

    public function basic_units(){
        return $this->belongsToMany('App\Basic_Unit')->withTimestamps();
    }

    public function orders(){
        return $this->belongsToMany('App\Order')->withTimestamps();
    }
}
