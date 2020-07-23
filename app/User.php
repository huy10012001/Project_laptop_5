<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
   

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
        'id','name', 'email','age','phone','address','image', 'password',
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
   
    
    public function cart()
    {
           
        return $this->hasOne('App\Cart');
   
    }
    public function role()
    {
           
        return $this->belongsToMany('App\role');
   
    }
    public function transaction()
    {
           
        return $this->hasMany('App\transaction');
   
    }
}
