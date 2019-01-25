<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemOrder extends Model
{
    protected $fillable = ['order_id','food_item_id','quantity'];

    public function food_item(){
        return $this->belongsTo('App\FoodItem','food_item_id');
    }
    public function order(){
        return $this->belongsTo('App\Order');
    }
}
