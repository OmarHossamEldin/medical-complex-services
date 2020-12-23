<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Model;

class SystemWorker extends Authenticatable
{
    use HasFactory;

    public $fillable = ['stakeholder_id', 'username', 'password', 'api_token'];

    protected $hidden = ['password'];
}
    