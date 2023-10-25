<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vs_os extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'sku_code',
        'quantity',
        'principal',
        'os_code',
        'date',
        'status',
        'sku_id',
        'unit_price',
    ];

    public function sku()
    {
      return $this->belongsTo('App\Models\Vs_os_inventories', 'sku_id','sku_id');
    }
}
