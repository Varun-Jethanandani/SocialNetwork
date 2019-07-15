<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    //Table Name
    protected $table = 'posts';
    // Primary Key
    public $primaryKey = 'post_id';
    // TimeStamps
    public $timestamps = 'true';  
    // Owner of this post

    protected $attributes = [
        'no_of_likes'=> 0,
        'no_of_comments'=> 0,
        'is_deleted'=>0,
        'post_type'=>0
    ];

    public function user(){
        return $this->belongsTo('App\User');
    }
}
