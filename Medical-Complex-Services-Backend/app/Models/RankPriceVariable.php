<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class RankPriceVariable extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['price_value'];

    public function ranks()
    {
        return $this->belongsToMany('App\Models\Rank', 'rank_price_variable_rank');
    }
}
