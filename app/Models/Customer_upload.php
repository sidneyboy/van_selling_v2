<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer_upload extends Model
{
    use HasFactory;

    protected $fillable = [
    	'user_id',
    	'customer_export_code',
    ];
}
