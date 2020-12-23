<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Permission extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'permission_role');
    }
}
