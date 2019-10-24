<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShipHistory extends Model
{
    protected $table = 'ship_history_tbl';

    public $primaryKey = 'id';
    
    public function user(){
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }
}
