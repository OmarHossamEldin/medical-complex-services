<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Pc extends Model
{
    use HasFactory, SoftDeletes;

    public $fillable = ['name', 'ip', 'mac_address'];

    public function transactions()
    {
        return $this->hasMany('App\Models\Transaction');
    }

    public function modules()
    {
        return $this->belongsToMany('App\Models\Module');
    }

    public function systemworkers()
    {
        return $this->belongsToMany('App\Models\SystemWorker');
    }

    public function services()
    {
        return $this->belongsToMany('App\Models\Service' , 'pc_service');
    }
}
