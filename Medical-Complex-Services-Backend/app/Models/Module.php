<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
class Module extends Model
{
    use HasFactory, SoftDeletes;

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
