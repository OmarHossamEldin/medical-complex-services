<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LinkedNodes extends Model
{
    use HasFactory;
    public $fillable = ['name', 'price', 'transaction_id'];

    public function transaction()
    {
        return $this->belongsTo('App\Models\Transaction');
    }
}
