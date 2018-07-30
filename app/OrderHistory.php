<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrderHistory extends Model
{
    //
    protected $fillable = ["order_information","user_id","delivery_collect_time",'delivery_or_collect',"total_cost","special_instructions","address"];
    protected $casts = [
        'order_information' => 'array',
    ];
}
