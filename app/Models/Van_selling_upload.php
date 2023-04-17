<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_upload extends Model
{
    use HasFactory;

    protected $fillable = [
    	'customer_id',
    	'van_selling_export_code',
    	'date',
    ];
}
