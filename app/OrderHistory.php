<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    //
    protected $fillable = ["order_information","user_id"];
    protected $casts = [
        'order_information' => 'array',
    ];
}
