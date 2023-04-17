<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection extends Model
{
    use HasFactory;

    protected $fillable = [
        'or_number',
    	'date_collected',
    	'total_amount_collected',
    	'customer_id',
        'principal_id',
    	'user_id',
        'status',
    ];

    public function collection_cash_check()
    {
      return $this->hasMany('App\Models\collection_cash_check', 'collection_id');
    }

    public function collection_details()
    {
      return $this->hasMany('App\Models\collection_details', 'collection_id');
    }

    public function collection_referal()
    {
      return $this->hasMany('App\Models\collection_referal', 'collection_id');
    }

    public function collection_image()
    {
      return $this->hasMany('App\Models\collection_image', 'collection_id');
    }

    public function customer()
    {
      return $this->belongsTo('App\Models\customer', 'customer_id');
    }

    public function principal()
    {
      return $this->belongsTo('App\Models\principal', 'principal_id');
    }

    public function agent()
    {
      return $this->belongsTo('App\Models\user', 'user_id');
    }
}
