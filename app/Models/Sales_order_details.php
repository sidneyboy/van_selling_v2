<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_order_details extends Model
{
    use HasFactory;

    protected $fillable = [
    	'sales_order_id',
    	'sku_id',
    	'quantity',
        'customer_id',
        'ending_inventory',
    	'remarks',
        'date',
        'sku_type',
        'unit_of_measurement',
        'price'
    ];

    public function sku()
    {
      return $this->belongsTo('App\Models\Sku_inventory', 'sku_id');
    }
}
