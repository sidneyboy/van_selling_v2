<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Bo extends Model
{
    use HasFactory;

    protected $fillable = [
    	'bo_number',
    	'customer_id',
    	'principal_id',
      'total_amount',
    	'user_id',
    	'date',
    ];

    public function bo_details()
    {
      return $this->hasMany('App\Models\bo_details', 'bo_id');
    }

    public function customer()
    {
      return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

     public function agent()
    {
      return $this->belongsTo('App\Models\User', 'user_id');
    }

     public function principal()
    {
      return $this->belongsTo('App\Models\Principal', 'principal_id');
    }
}
