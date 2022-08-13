<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    protected $table = 'reviews';
    protected $fillable = ['star', 'review','product_id', 'order_id'];

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
