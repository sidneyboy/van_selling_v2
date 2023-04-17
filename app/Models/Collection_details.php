<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection_details extends Model
{
    use HasFactory;

    protected $fillable = [
    	'collection_id',
    	'total_dr_amount',
    	'cash',
    	'check',
        'over_payment',
    	'remarks',
    	'delivery_receipt',
    	
    ];

     public function collection()
    {
      return $this->belongsTo('App\Models\collection', 'collection_id');
    }

    public function collection_referal()
    {
      return $this->hasMany('App\Models\collection_referal', 'collection_id');
    }
}
