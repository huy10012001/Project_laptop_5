<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SocialAccount extends Model
{
    protected $table = "social_accounts";
    protected $fillable = ['id','user_id', 'provider_id', 'provider'];
    protected $primaryKey = 'id';
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
