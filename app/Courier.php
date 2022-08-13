<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courier extends Model
{
    //
    protected $table = 'couriers';
    protected $fillable = [
        'code', 'nama_couriers'
    ];
}