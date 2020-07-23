<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class transaction extends Model
{
    // khai báo table ứng với model
    protected $table = "transaction";
    // khai báo trường khóa chính
    protected $primaryKey = 'id';
    
    // mặc định khóa chính sẽ tự động tăng
    public $incrementing = true;   // false: khóa chỉnh sẽ không tự động tăng
    protected $fillable = ['id','status' ,'user_id', 'amount', 'date', 'updated_at', 'created_at'];
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    public function order()
    {
        return $this->hasOne('App\Order');
    }
    
}
