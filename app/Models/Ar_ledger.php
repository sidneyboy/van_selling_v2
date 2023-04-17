<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ar_ledger extends Model
{
    use HasFactory;

    protected $fillable = [
    	'customer_id',
    	'user_id',
        'export_code',
    	'date_delivered',
    	'delivery_receipt',
    	'amount',
    	'collected',
    	'balance',
    	'check_details',
    	'total_cm',
    	'final_balance',
    ];
}
