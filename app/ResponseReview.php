<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ResponseReview extends Model
{
    protected $table = 'response_review';
    protected $fillable = ['tanggapan', 'review_id', 'user_id'];
}
