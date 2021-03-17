<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class VariableLabel extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['key', 'label', 'data_type', 'time_type', 'service_id'];

    public function service()
     {
         return $this->belongsTo('App\Models\Service');
     }
}
