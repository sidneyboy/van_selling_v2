<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_calls extends Model
{
    use HasFactory;

    protected $fillable = [
        'store_name',
        'location_id',
        'address',
        'date',
        'remarks',
    ];
}
