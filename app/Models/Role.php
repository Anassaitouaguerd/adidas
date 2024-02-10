<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    protected $fillable = [
        'role',
    ];
    public function user()  
    {
        return $this->hasMany(User::class);
    }
    public function Role_Permession()
    {
        return $this->hasMany(Role_Permission::class);
    }
}
