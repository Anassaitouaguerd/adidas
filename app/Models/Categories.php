<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
  protected $info_category = [
    'name',
    'image',
  ];
  public function product()
  {
      return $this->hasMany(Product::class);
  }
  
}
