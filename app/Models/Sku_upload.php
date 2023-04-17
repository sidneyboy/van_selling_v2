<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sku_upload extends Model
{
    use HasFactory;

    protected $fillable = [
    	'sku_upload_code',
    ];

}
