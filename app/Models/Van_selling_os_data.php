<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_os_data extends Model
{
    use HasFactory;

    protected $fillable = [
        'van_selling_inventory_id',
        'vs_customer_id',
        'store_name',
        'sku_code',
        'description',
        'quantity',
        'principal',
        'served_quantity',
        'served_date',
        'date',
        'status',
        'temp_quantity',
        'code',
        'unit_price',
        'served_unit_price',
        'temp_unit_price',
    ];

    public function sku()
    {
        return $this->belongsTo('App\Models\Van_selling_inventories', 'van_selling_inventory_id');
    }
}
