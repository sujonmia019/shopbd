<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'product_id','qty','price','user_ip'
    ];

    public function product(){
        return $this->belongsTo('App\Models\Product');
    }
}
