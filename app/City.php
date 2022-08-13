<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $guarded = [];
    protected $table = 'cities';
    protected $fillable = [
        'province_id', 'city_id','nama_cities'
    ];
}
