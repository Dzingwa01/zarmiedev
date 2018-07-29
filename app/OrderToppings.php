<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderToppings extends Model
{
    //
    protected $fillable = ['order_id','topping_id','name'];
}
