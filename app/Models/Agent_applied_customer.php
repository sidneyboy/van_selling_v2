<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Agent_applied_customer extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'customer_id',
    	'location_id',
    ];

    public function customer()
    {
      return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
