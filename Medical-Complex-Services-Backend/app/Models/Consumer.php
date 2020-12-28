<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Consumer extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['stakeholder_id'];

    protected $primaryKey = 'stakeholder_id';

    public function transactions()
    {
        return $this->belongsToMany('App\Models\Transaction', 'consumer_transaction');
    }
}
