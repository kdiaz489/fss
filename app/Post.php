<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{   //This is our Model aka what connects to / communicates with the database

    
    //Table Name (not necessary, just for reference)
    protected $table = 'posts';

    //Primary Key
    public $primaryKey = 'id';

    //Timestamp
    public $timestamps = true;

    public function user(){
        //Post has a relationship with a user and belongs to this user.
        return $this->belongsTo('App\User');
    }
    
}
