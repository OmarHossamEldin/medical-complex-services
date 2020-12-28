<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class FinancialCategory extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['name', 'operator', 'value', 'max_limit'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'financial_category_service');
    }
}
