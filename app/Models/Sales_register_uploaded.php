<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sales_register_uploaded extends Model
{
    use HasFactory;

    protected $fillable = [
    	'customer_id',
    	'export_id',
    	'total_amount',
    	'dr',
    	'date',
    	'principal_id',
    	'user_id',
        'status'
    ];

    public function sales_register_details()
    {
      return $this->hasMany('App\Models\Sales_register_details', 'sales_register_id');
    }

    public function principal()
    {
      return $this->belongsTo('App\Models\principal', 'principal_id');
    }

      public function agent()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }
}
