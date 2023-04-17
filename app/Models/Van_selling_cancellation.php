<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Van_selling_cancellation extends Model
{
    use HasFactory;

    protected $fillable = [
    	'van_selling_trans_id',
    	'remarks',
    	'date',
    ];

    public function van_selling_transaction()
    {
      return $this->belongsTo('App\Models\Van_selling_transaction', 'van_selling_trans_id');
    }

    public function van_selling_cancellation_details()
    {
      return $this->hasMany('App\Models\Van_selling_cancellation_details', 'vs_cancelation_id');
    }
}
