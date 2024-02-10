<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permissions extends Model
{
    use HasFactory;
    protected $fillable = [
        'permissions',
    ];
    public function Role_permession()
    {
        return $this->hasMany(Role_permission::class);
    }
}
