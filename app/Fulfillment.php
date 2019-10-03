<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Fulfillment extends Model
{
    protected $table = 'stor_wk_tbl';

    public $primaryKey = 'id';

    public function user(){
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }
}
