<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SystemWorker extends Model
{
    use HasFactory;

    public $fillable = ['stakeholder_id', 'username', 'password', 'api_token'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }
}
