<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RankPriceVariable extends Model
{
    use HasFactory;
    public $fillable = ['price_value'];
}
