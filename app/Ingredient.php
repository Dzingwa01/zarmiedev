<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Ingredient extends Model
{
    use SoftDeletes;

  protected $table = 'ingredient';
  protected $primaryKey ='id';
    protected $dates = ['deleted_at'];

  protected $fillable = [
      'name', 'description','prize','ingredient_type_id','medium_prize','large_prize','wrap_prize'
  ];

}
