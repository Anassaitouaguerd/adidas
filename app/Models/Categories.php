<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Categories extends Model
{
  protected $info_category = [
    'name',
  ];
  public function product()
  {
      return $this->belongsTo(Categories::class);
  }
  
}
