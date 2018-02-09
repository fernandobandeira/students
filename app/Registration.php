<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $guarded = ['id'];

    public function student()
    {
        return $this->belongsto('App\Student');
    }

    public function course()
    {
        return $this->belongsto('App\Course');
    }
}
