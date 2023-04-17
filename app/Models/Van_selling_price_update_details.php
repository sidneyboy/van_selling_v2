<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_price_update_details extends Model
{
    use HasFactory;

    protected $fillable = [
    	'vs_price_update_id',
    	'sku_code',
    	'description',
    	'updated_price',
    ];
}
