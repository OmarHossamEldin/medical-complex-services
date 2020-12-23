<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;
    public $fillable = ['printing_count', 'system_worker_id', 'pc_id', 'financial_category_id', 'service_id'];

    public function system_worker()
    {
        return $this->belongsTo('App\Models\SystenWorker');
    }

    public function pc()
    {
        return $this->belongsTo('App\Models\Pc');
    }

    public function financial_category()
    {
        return $this->belongsTo('App\Models\FinancialCategory');
    }

    public function service()
    {
        return $this->belongsTo('App\Models\Service');
    }

    public function linked_nodes()
    {
        return $this->hasMany('App\Models\LinkedNodes');
    }
}
