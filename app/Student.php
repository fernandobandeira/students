<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    protected $dates = [
        'nascimento',
    ];

    protected $guarded = ['created_at'];
}
