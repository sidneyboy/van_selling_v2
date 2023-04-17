<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_transaction_cm extends Model
{
    use HasFactory;

    protected $fillable = [
    	'van_selling_trans_id',
    	'date',
    	'user_id',
    ];
}
