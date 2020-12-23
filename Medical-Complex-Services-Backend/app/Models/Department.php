<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }
}
