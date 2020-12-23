<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Module extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function pcs()
    {
        return $this->belongsToMany('App\Models\Pc');
    }

    public function systemworkers()
    {
        return $this->belongsToMany('App\Models\SystemWorker', 'module_system_worker');
    }
}
