<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class BillingOption extends Model
{
    use HasFactory;

    public $fillable = ['name'];

    public function services()
    {
        return $this->belongsToMany('App\Models\Service', 'billing_option_service');
    }
}
