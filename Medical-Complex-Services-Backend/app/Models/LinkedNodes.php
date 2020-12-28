<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class LinkedNodes extends Model
{
    use HasFactory, SoftDeletes;
    public $fillable = ['name', 'price', 'transaction_id'];

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }
}
