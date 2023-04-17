<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection_cash_check extends Model
{
    use HasFactory;

    protected $fillable = [
    	'collection_id',
    	'particulars',
    	'check_no',
    	'bank',
    	'check_date',
    	'amount',
    	'remarks',
    ];

    public function collection()
    {
      return $this->belongsTo('App\Models\collection', 'collection_id');
    }
}
