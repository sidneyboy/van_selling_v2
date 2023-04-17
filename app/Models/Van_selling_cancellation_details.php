<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_cancellation_details extends Model
{
    use HasFactory;

    protected $fillable = [
		'vs_cancelation_id',
		'sku_code',
		'description',
		'principal',
		'quantity',
		'unit_price',
		'unit_of_measurement',
    ];

    // public function van_selling_cancellation()
    // {
    //   return $this->belongsTo('App\Models\Van_selling_cancellation', 'vans_cancelation_id');
    // }
}
