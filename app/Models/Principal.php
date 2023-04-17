<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Principal extends Model
{
    use HasFactory;

      protected $fillable = [
      	'id',
        'principal',
    ];

    public function customer()
    {
      return $this->belongsTo('App\Models\Customer', 'customer_id');
    }
}
