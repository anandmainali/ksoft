<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FoodItem extends Model
{
    protected $fillable = ['name','price','description'];

    public function categories()
    {
        return $this->belongsToMany('App\Category');
    }

    public function dates()
    {
        return $this->belongsToMany('App\Date', 'menu_of_the_days', 'food_item_id','date_id');
    }

}
