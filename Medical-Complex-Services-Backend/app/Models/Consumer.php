<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Consumer extends Model
{
    use HasFactory;
    public $fillable = ['stakeholder_id'];

    public function transactions()
    {
        return $this->belongsToMany('App\Models\Transaction', 'consumer_transaction');
    }
}