<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Drink extends Model
{
    //
    use SoftDeletes;
    protected $fillable = ['name','category_id','prize','size','image_url'];
}
