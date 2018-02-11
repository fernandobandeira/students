<?php

namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    protected $dates = [
        'data_cancelamento',
    ];

    protected $guarded = ['created_at'];

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

    public static function boot()
    {
        parent::boot();
        self::created(function ($registration) {
            $data = Carbon::now();
            Payment::create([
                'nome'            => 'Matrícula',
                'valor'           => $registration->course->valor_matricula,
                'data_final'      => $data,
                'registration_id' => $registration->id,
            ]);
            for ($i = 1; $i <= $registration->course->duracao; $i++) {
                Payment::create([
                    'nome'            => 'Mensalidade '.$i.'/'.$registration->course->duracao,
                    'valor'           => $registration->course->mensalidade,
                    'data_final'      => $data,
                    'registration_id' => $registration->id,
                ]);
                $data->addMonth();
            }
        });
    }
}
