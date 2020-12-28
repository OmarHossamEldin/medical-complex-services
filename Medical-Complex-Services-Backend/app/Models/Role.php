<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Role extends Model
{
    use HasFactory, SoftDeletes;
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
