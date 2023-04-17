<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $fillable = [
    	'id',
    	'location_id',
    	'detailed_location',
    	'store_name',
    	'kind_of_business',
    ];

    public function location()
    {
      return $this->belongsTo('App\Models\Location', 'location_id');
    }

    public function customer_principal_code()
    {
      return $this->hasMany('App\Models\customer_principal_code', 'customer_id');
    }

    public function customer_principal_price()
    {
      return $this->hasMany('App\Models\customer_principal_price', 'customer_id');
    }

}
