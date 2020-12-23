<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Degree extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function doctors()
    {
        return $this->hasMany('App\Models\Doctor');
    }
}
