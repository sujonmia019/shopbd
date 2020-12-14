<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderDetails extends Model
{
    protected $table = 'order_details';
    protected $guarded  = ['created_at','updated_at'];

    public function product(){
        return $this->belongsTo(Product::class, 'product_id','id');
    }
}
