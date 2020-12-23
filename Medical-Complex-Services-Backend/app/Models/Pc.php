<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pc extends Model
{
    use HasFactory;

    public $fillable = ['name', 'ip', 'mac_address'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
