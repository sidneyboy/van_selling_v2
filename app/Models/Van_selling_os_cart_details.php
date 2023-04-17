<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_os_cart_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'van_selling_inventory_id',
        'sku_code',
        'quantity',
        'principal',
        'unit_price',
    ];

    public function van_selling_os_sku()
    {
      return $this->belongsTo('App\Models\Van_selling_inventories', 'van_selling_inventory_id');
    }
}
