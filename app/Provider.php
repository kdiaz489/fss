<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Provider extends Model
{
    public function users(){
        return $this->belongsToMany('App\User')->using('App\ProviderUser')->withPivot('api_key', 'api_pass', 'shop_name')->withTimestamps();
    }
}
