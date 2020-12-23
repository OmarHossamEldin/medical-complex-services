<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceType extends Model
{
    use HasFactory;
    public $fillable = ['name'];

    public function services()
    {
        return $this->hasMany('App\Models\Service');
    }
}
