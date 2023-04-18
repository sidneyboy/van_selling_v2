<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vs_os extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'sku_code',
        'quantity',
        'principal',
        'os_code',
        'date',
        'status',
    ];
}
