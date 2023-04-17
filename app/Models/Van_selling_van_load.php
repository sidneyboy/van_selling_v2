<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_van_load extends Model
{
    use HasFactory;

    protected $fillable = [
    	'delivery_receipt',
    	'date',
    	'principal',
    	'new_van_load',
        'remarks',
    ];
}
