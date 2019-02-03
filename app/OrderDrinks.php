<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderDrinks extends Model
{
    //
    protected $fillable = ['order_id','drink_id','name'];

    public function order(){
        return $this->belongsTo(Order::class,'order_id');
    }

}
