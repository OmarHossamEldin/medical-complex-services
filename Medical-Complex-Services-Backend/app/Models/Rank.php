<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rank extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function stakeholders()
    {
        return $this->hasMany('App\Models\Stakeholder');
    }

    public function rank_price_variables()
    {
        return $this->belongsToMany('App\Models\RankPriceVariable');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'rank_service');
    }
}
