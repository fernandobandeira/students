<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\PaymentRequest;
use App\Payment;

class PaymentsController extends Controller
{
    public function show(Payment $payment) {
        return view('payments.show')
            ->with('payment', $payment);
    }

    public function update(PaymentRequest $request, Payment $payment) {
        $payment->pago = 1;
        $payment->save();

        $troco = $this->calcula_troco($payment->valor, $request->valor);

        return redirect()
            ->route('registrations.show', $payment->registration_id)
            ->with('success', 'Pagamento realizado com sucesso.')
            ->with('troco', $troco);
    }

    public static function calcula_troco($valor, $pago) {
        $troco = false;
        if ($valor < $pago) {
            $troco = $pago - $valor;

            $cedulas = [100, 50, 10, 5, 1, .5, .1, .05, .01];
            $atual = 0;
            $total = [0, 0, 0, 0, 0, 0, 0, 0, 0];
            
            while ($troco != 0) {                
                if ($cedulas[$atual] <= $troco) {                    
                    $troco -= $cedulas[$atual];
                    $total[$atual] += 1;
                } else {
                    $atual += 1;
                }
                
                $troco = round($troco, 2);
            }
            
            $troco = $total;
        }

        return $troco;
    }
}
