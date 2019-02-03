<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderIngredient extends Model
{
    //
    protected $fillable = ['order_id','ingredient_id','name'];

    public  function order(){
        return $this->belongsTo(Order::class);
    }

    public function ingredient(){
        return $this->belongsTo(Ingredient::class);
    }
}
