<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PriceType extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['name'];

    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
}
