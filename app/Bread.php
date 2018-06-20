<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Bread extends Model
{
  protected $table = 'bread';
  protected $primaryKey ='id';
  protected $fillable = [
      'name', 'description',
  ];
}
