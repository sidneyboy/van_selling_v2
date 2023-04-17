<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_order extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'customer_id',
        'sales_order_number',
    	'principal_id',
        'sku_type',
    	'date',
        'mode_of_transaction'
    ];

    public function sales_order_details()
    {
      return $this->hasMany('App\Models\Sales_order_details', 'sales_order_id','id');
    }

     public function customer()
    {
      return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

     public function principal()
    {
      return $this->belongsTo('App\Models\Principal', 'principal_id');
    }

     public function agent()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
