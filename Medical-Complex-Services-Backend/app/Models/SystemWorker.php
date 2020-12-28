<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\SoftDeletes;

class SystemWorker extends Authenticatable
{
    use HasFactory, SoftDeletes;

    public $fillable = ['stakeholder_id', 'username', 'password', 'api_token'];

    protected $primaryKey = 'stakeholder_id';

    protected $hidden = ['password'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Models\Module');
    }

    public function pcs()
    {
        return $this->belongsToMany('App\Models\Pc', 'pc_system_worker');
    }
}
