<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bo_details extends Model
{
    use HasFactory;

    protected $fillable = [
    	'bo_id',
    	'sku_id',
        'price',
    	'rgs_quantity',
        'bo_quantity',
    	'remarks'
    ];

    public function sku()
    {
      return $this->belongsTo('App\Models\Sku_inventory', 'sku_id');
    }
}
