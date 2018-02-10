<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $dates = [
        'data_cancelamento',
    ];

    protected $guarded = ['id'];

    public function getAtivaAttribute()
    {
        $data_cancelamento = $this->data_cancelamento;

        if ($data_cancelamento) {
            if ($data_cancelamento->format('Y-m') == Carbon::now()->format('Y-m')) {
                return 'Sim';
            }

            return 'Não';
        }

        return 'Sim';
    }

    public function getPagaAttribute()
    {
        $payments = $this->payments;
        $payments = $payments->where('pago', false)
            ->where('data_final', '<', Carbon::now());

        if ($payments->count() !== 0) {
            return 'Não';
        }

        return 'Sim';
    }

    public function student()
    {
        return $this->belongsto('App\Student');
    }

    public function course()
    {
        return $this->belongsto('App\Course');
    }

    public function payments()
    {
        return $this->hasMany('App\Payment');
    }
}
