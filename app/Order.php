<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $fillable = ['user_id','totalPrice','status','date'];

    
    public function order_items()
    {
        return $this->hasMany('App\ItemOrder');
    }

    
    public function user()
    {
        return $this->belongsTo('App\User');
    }
    
    
}
