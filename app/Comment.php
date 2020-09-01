<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    //
    
    //
    
    protected $table = "comment";
    public function product()
    {
        return $this->belongsto('App\Product','product_id','id');
    }
    public function user()
    {
        return $this->belongsto('App\User','user_id','id');
    }
}