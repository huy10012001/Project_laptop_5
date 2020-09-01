<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;


class User extends Authenticatable
{

     use Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = "user";
    // khai báo trường khóa chính
    protected $primaryKey = 'id';
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;  
    protected $fillable = [
        'id','name', 'email','age','phone','address','image', 'password','provider','provider_id'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
   

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
   
    
  
    public function role()
    {
           
        return $this->belongsToMany('App\role');
    }
    public function Order()
    {
           
        return $this->hasMany('App\Order');
   
    }
    public function comment()
    {
        return $this->hasMany('App\Comment');
    }
    public function account()
    {
        return $this->hasMany('App\SocialAccount');
    }
   
}
