<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FollowerConstraint extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['name', 'active'];

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'follower_constraint_service');
    }
}
