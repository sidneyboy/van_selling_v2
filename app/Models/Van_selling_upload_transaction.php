<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_upload_transaction extends Model
{
    use HasFactory;

    protected $fillable = [
    	'sku_code',
    	'description',
    	'sku_type',
    	'unit_of_measurement',
    	'quantity',
    	'unit_price_left',
    	'total_left',
    	'butal_equivalent',
    	'quantity_butal',
    	'unit_price_right',
    	'total_right'
    ];
}
