<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Transaction extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['printing_count', 'system_worker_id', 'pc_id', 'financial_category_id', 'service_id'];

    public function system_worker()
    {
        return $this->belongsTo('App\Models\SystemWorker', 'system_worker_id');
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

    public function consumers()
    {
        return $this->belongsToMany('App\Models\Consumer');
    }

    public function doctors()
    {
        return $this->belongsToMany('App\Models\Doctor', 'doctor_transaction');
    }
}
