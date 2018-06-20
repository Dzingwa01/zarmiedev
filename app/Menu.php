<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
  protected $table = 'menu_item';
  protected $primaryKey ='id';
  protected $fillable = [
      'name', 'description', 'category_id','item_size_id','prize',
  ];

public function category(){
  return $this->hasOne('App\Category','id');
}

public function item_ingredients(){
  return $this->hasMany('App\ItemIngredient','item_id');
}

}
