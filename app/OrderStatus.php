<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    //
    protected $fillable = ['status','order_id'];

    public function order(){

        return $this->belongsTo(Order::class, 'order_id');
    }
}
