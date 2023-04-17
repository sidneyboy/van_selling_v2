<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_transaction_details extends Model
{
    use HasFactory;

    protected $fillable = [
    	'sku_code',
        'description',
    	'quantity',
        'principal',
    	'price',
    	'amount',
    	'van_selling_trans_id',
    	'status',
        'remarks',
    ];

     public function van_selling_transaction()
    {
      return $this->belongsTo('App\Models\Van_selling_transaction', 'van_selling_trans_id');
    }
}
