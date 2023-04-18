<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vs_os_cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku_code',
        'quantity',
    ];

    public function sku()
    {
        return $this->belongsTo('App\Models\Vs_os_inventories', 'sku_code','sku_code');
    }
}
