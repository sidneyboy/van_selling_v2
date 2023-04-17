<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Summary_of_transaction_ledger extends Model
{
    use HasFactory;

    protected $fillable = [
    	'customer_id',
    	'so_number',
    	'so_amount',
    	'dr',
    	'ref_id',
    	'check_no',
    	'check_date',
    	'collection',
    	'bo',
    	'image',
        'remarks',
        'date',
    ];


    public function customer()
    {
      return $this->belongsTo('App\Models\Customer', 'customer_id');
    }

    public function collection_image()
    {
      return $this->hasOne('App\Models\Collection_image', 'collection_id', 'ref_id');
    }
}
