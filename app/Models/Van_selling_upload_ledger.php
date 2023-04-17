<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_upload_ledger extends Model
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
    	'beg',
    	'van_load',
    	'sales',
        'adjustments',
    	'end',
    	'unit_price',
        'status',
        'status_cancel',
        'date',
    ];
}
