<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['user_id','phone_number','item_name','item_category','bread_type','prize','address','quantity','toast_type','extra_instructions','delivery_or_collect','delivery_time'];

    public function order_ingredients(){
        return $this->hasMany(OrderIngredient::class);
    }

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }

    public function drinks(){
        return $this->hasMany(OrderDrinks::class);
    }

    public function toppings(){
        return $this->hasMany(OrderToppings::class,'order_id');
    }

    public function status(){
        return $this->hasOne(OrderStatus::class,'order_id');
    }
}
