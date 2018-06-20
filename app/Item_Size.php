<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Item_Size extends Model
{
  protected $table = 'item_sizes';
  protected $primaryKey ='id';
  protected $fillable = [
      'name', 'description',
  ];
}
