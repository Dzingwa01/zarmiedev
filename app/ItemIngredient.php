<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ItemIngredient extends Model
{
  protected $table = 'item_ingredient';
  protected $primaryKey ='id';
  protected $fillable = [
      'item_id', 'ingredient_id',
  ];

public function ingredient(){
  return $this->hasOne('App\Ingredient','id','ingredient_id');
}

}
