<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $info_product = [
        'name' ,
        'description',
        'price',
        'image',
        'category_id',
    ];
    public function categories()
    {
        return $this->belongsTo(Categories::class);
    }
}
