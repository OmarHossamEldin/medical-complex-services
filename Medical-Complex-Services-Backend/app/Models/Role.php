<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    public function permissions()
    {
        return $this->belongsToMany('App\Models\Permission');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'role_service');
    }
}
