<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $dates = [
        'data_final',
    ];

    protected $guarded = ['created_at'];
}
