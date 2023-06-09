<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_transaction_cart_details extends Model
{
    use HasFactory;

    protected $fillable = [
    	'sku_code',
        'description',
        'principal',
        'quantity',
        'unit_of_measurement',
        'sku_type',
        'butal_equivalent',
        'beg',
        'price',
        'user_id',
    ];
}
