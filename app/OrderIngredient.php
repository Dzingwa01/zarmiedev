<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderIngredient extends Model
{
    //
    protected $fillable = ['order_id','ingredient_id'];
}
