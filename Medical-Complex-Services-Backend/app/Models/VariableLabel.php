<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VariableLabel extends Model
{
    use HasFactory;
    public $fillable = ['key', 'label', 'data_type', 'time_type', 'service_id'];
}
