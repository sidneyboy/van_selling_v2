<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_principal_price extends Model
{
    use HasFactory;

    protected $fillable = [
    	'customer_id',
    	'principal_id',
    	'price_level',
    ];

    public function principal()
    {
      return $this->belongsTo('App\Models\Principal', 'principal_id');
    }
}
