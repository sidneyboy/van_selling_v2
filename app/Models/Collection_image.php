<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Collection_image extends Model
{
    use HasFactory;

    protected $fillable = [
    	'collection_id',
    	'image',
    ];

     public function collection()
    {
      return $this->belongsTo('App\Models\collection', 'collection_id');
    }
}
