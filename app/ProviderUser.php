<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Support\Facades\Crypt;

class ProviderUser extends Pivot
{
    /**
     * Indicates if the IDs are auto-incrementing.
     *
     * @var bool
     */
    public $incrementing = true;

    public function setApiKeyAttribute($value)
    {
        $this->attributes['api_key'] = Crypt::encryptString($value);
    }

    public function getApiKeyAttribute($value)
    {
        return Crypt::decryptString($value);
    
    }

    public function setApiPassAttribute($value){
        $this->attributes['api_pass'] = Crypt::encryptString($value);
    }

    public function getApiPassAttribute($value){
        return Crypt::decryptString($value);
    }

    public function setShopNameAttribute($value){
        $this->attributes['shop_name'] = Crypt::encryptString($value);
    }

    public function getShopNameAttribute($value){
        return Crypt::decryptString($value);
    }

}
