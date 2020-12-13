<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    protected $table = 'Wishlists';

    protected $fillable = [
        'user_id','product_id'
    ];

    public function productInfo(){
        return $this->belongsTo('App\Models\Product','product_id');
    }
}
