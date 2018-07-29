<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    //
    protected $fillable = ['user_id','phone_number','item_name','item_category','bread_type','prize','address','quantity','toast_type','quantity'];
}
