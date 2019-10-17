<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'company_name', 'name', 'user_name', 'street_address', 'city', 'state', 'zip', 'email', 'discount', 'credit', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        // A user has many posts, a one to many relationship
        return $this->hasMany('App\Post');
        
    }

    public function shipments(){
        // A user has many posts, a one to many relationship
        
        return $this->hasMany('App\Shipment');
    }

    public function storage(){
        // A user has many posts, a one to many relationship
        
        return $this->hasMany('App\Storage');
    }

    public function storagework(){
        // A user has many posts, a one to many relationship
        
        return $this->hasMany('App\StorageWork');
    }

    public function basic_units(){
        return $this->hasMany('App\Basic_Unit');
    }

    public function kits(){
        return $this->hasMany('App\Kit');
    }

    public function orders(){
        return $this->hasMany('App\Order');
    }

    public function roles(){
        return $this->belongsToMany('App\Role');
    }
    public function hasAnyRoles($roles){
        return null !== $this->roles()->whereIn('name', $roles)->first();
    }
    public function hasAnyRole($role){
        return null !== $this->roles()->where('name', $role)->first();
    }
}
