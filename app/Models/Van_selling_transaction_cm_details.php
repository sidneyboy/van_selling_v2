<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_transaction_cm_details extends Model
{
    use HasFactory;

    protected $fillable = [
    	'vs_trans_cm_id',
    	'sku_code',
    	'description',
    	'dr_quantity',
    	'rgs_quantity',
    	'bo_quantity',
    	'unit_price',
    	'remarks',
    ];
}
