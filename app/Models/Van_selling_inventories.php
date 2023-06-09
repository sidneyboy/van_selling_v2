<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_inventories extends Model
{
    use HasFactory;

    protected $fillable = [
        'sku_code',
        'description',
        'principal',
        'sku_type',
        'unit_of_measurement',
        'unit_price',
    ];
}
