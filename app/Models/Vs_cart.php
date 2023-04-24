<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vs_cart extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku_code',
        'description',
        'principal',
        'quantity',
        'unit_of_measurement',
        'sku_type',
        'price',
        'sku_id',
    ];

    public function sku()
    {
        return $this->belongsTo('App\Models\Vs_upload_inventory', 'sku_id', 'sku_id');
    }
}
