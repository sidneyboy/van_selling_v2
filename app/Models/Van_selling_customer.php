<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_customer extends Model
{
  use HasFactory;

  protected $fillable = [
    'store_name',
    'store_type',
    'address',
    'location_id',
    'barangay',
    'contact_person',
    'contact_number',
    'longitude',
    'latitude',
    'status',
    'remarks',
  ];

  public function location()
  {
    return $this->belongsTo('App\Models\Location', 'location_id');
  }
}
