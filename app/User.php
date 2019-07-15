<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    //
    //Table Name
    protected $table = 'users';
    // Primary Key
    public $primaryKey = 'id';
    // TimeStamps
    public $timestamps = 'true';  
    // Owner of this post
    public function post(){
        return $this->hasMany('App\Post');
    }
}
