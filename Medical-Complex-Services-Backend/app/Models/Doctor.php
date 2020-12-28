<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Doctor extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['system_worker_id' , 'degree_id' , 'department_id'];

    protected $primaryKey = 'system_worker_id';

    public function degree()
    {
        return $this->belongsTo('App\Models\Degree');
    }

    public function department()
    {
        return $this->belongsTo('App\Models\Department');
    }

    public function transactions()
    {
        return $this->belongsToMany('App\Models\Transaction', 'doctor_transaction');
    }
}
