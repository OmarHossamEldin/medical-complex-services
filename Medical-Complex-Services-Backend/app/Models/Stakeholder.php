<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stakeholder extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'wallet', 'patient_code', 'barcode', 'rank_id', 'stakeholder_id'];

    public function rank()
    {
        return $this->belongsTo('App\Models\Rank');
    }
}
