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
    ];
}
