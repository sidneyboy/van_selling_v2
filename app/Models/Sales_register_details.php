<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_register_details extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_register_id',
    	'sku_id',
    	'quantity',
    	'price',
    	'amount',
        'sku_type',
    ];

    public function sku()
    {
      return $this->belongsTo('App\Models\Sku_inventory', 'sku_id');
    }

    // public function sales_register_upload()
    // {
    //   return $this->belongsTo('App\Models\Sales_register', 'sales_register_id');
    // }

  
}
