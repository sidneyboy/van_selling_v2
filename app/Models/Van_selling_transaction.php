<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_transaction extends Model
{
    use HasFactory;

    protected $fillable = [
      'delivery_receipt',
      'store_name',
      'store_type',
      'full_address',
      'total_amount',
      'pcm_number',
      'bo_amount',
      'date',
      'status',
      'remarks',
      'address',
      'barangay',
    ];

    public function van_selling_transaction_details()
    {
      return $this->hasMany('App\Models\Van_selling_transaction_details', 'van_selling_trans_id');
    }

    public function location()
    {
      return $this->hasMany('App\Models\Location', 'full_address');
    }

    public function van_selling_bo_deduction()
    {
      return $this->hasOne('App\Models\van_selling_bo_deduction', 'van_selling_trans_id');
    }
}
