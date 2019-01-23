<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Date extends Model
{
    protected $fillable = ['date'];

    public function food_items()
    {
        return $this->belongsToMany('App\FoodItem', 'menu_of_the_days', 'date_id', 'food_item_id');
    }
}
