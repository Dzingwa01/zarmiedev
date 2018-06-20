<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class IngredientType extends Model
{
  protected $table = 'ingredient_type';
  protected $primaryKey ='id';
  protected $fillable = [
      'type_name', 'description',
  ];

}
