<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ClosedInterval extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['day', 'from', 'to'];

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'closed_interval_service');
    }
}
