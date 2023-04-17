<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku_inventory extends Model
{
    use HasFactory;

     protected $fillable = [
    	'id',
    	'sku_code',
    	'description',
    	'sku_type',
        'unit_of_measurement',
    	'principal_id',
    	'running_balance',
    	'price_1',
    	'price_2',
    	'price_3',
    	'price_4',
    ];

    public function principal()
    {
      return $this->belongsTo('App\Models\Principal', 'principal_id');
    }
}
