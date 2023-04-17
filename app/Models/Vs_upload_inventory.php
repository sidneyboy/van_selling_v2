<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vs_upload_inventory extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'principal',
        'sku_code',
        'description',
        'unit_of_measurement',
        'sku_type',
        'butal_equivalent',
        'reference',
        'quantity',
        'running_balance',
        'unit_price',
        'status',
        'status_cancel',
        'date',
    ];
}
