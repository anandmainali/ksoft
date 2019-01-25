<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    protected $fillable = ['name'];

    public function food_item()
    {
        return $this->belongsToMany('App\FoodItem');
    }
}
