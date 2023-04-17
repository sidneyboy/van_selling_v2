<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection_referal extends Model
{
    use HasFactory;

    protected $fillable = [
    	'collection_id',
    	'refer_agent',
    	'refer_delivery_receipt',
    	'refer_principal',
    	'refer_cash',
    	'refer_check',
    	'refer_remarks',
    ];

    public function collection()
    {
      return $this->belongsTo('App\Models\collection', 'collection_id');
    }
}
