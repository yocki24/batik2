<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    protected $guarded = [];
    protected $table = 'provinces';
    protected $fillable = [
        'provinces_id', 'nama_province'
    ];
}
