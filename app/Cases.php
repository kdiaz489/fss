<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
class Cases extends Model{
    protected $table = 'cases';

    public $primaryKey = 'id';

    

    public function user(){
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }

    public function basic_units(){
        return $this->belongsToMany('App\Basic_Unit')->withPivot('quantity')->withTimestamps();
    }

    public function kits(){
        return $this->belongsToMany('App\Kit')->withTimestamps();
    }

    public function orders(){
        return $this->belongsToMany('App\Order')->withPivot('quantity')->withTimestamps();
    }
}
