<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $fillable = ['printing_count', 'system_worker_id', 'pc_id', 'financial_category_id', 'service_id'];
}
