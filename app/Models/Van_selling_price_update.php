<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_price_update extends Model
{
    use HasFactory;

    protected $fillable = [
    	'van_selling_price_update_export_code',
    	'date',
    ];
}
