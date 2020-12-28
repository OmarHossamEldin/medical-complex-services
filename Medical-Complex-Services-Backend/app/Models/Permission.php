<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Permission extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['name'];

    public function roles()
    {
        return $this->belongsToMany('App\Models\Role', 'permission_role');
    }
}
