<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    //
    protected $table = 'products';
    protected $fillable = ['name','image','description','price','weigth','categories_id','stok', 'pengrajin_id'];

    //User hasmany review
    public function reviews()
    {
        return $this->hasMany(Review::class);
    }
}
