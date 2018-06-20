<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Ingredient extends Model
{
  protected $table = 'ingredient';
  protected $primaryKey ='id';
  protected $fillable = [
      'name', 'description','prize','ingredient_type_id',
  ];
}
