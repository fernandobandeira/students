<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\RegistrationRequest;
use App\Payment;
use App\Registration;
use App\Student;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegistrationsController extends Controller
{
    public function index(Request $request)
    {
        $registrations = Registration::query()
            ->with('payments');
        if (!$request->inativa) {
            $registrations = $registrations->where(function($q) {
                # cancelado no mesmo mes ou nao foi cancelada
                return $q->whereMonth('data_cancelamento', Carbon::now()->month)
                    ->whereYear('data_cancelamento', Carbon::now()->year)
                    ->orWhere('data_cancelamento', null);
            });
        }
        if ($request->nome) {
            $registrations = $registrations->whereHas('student', function ($q) use ($request) {
                return $q->where('nome', 'like', '%'.$request->nome.'%');
            });
        }
        if ($request->course_id) {
            $registrations = $registrations->where('course_id', $request->course_id);
        }
        if ($request->ano) {
            $registrations = $registrations->where('ano', $request->ano);
        }
        if ($request->paga) {
            $registrations = $registrations->whereDoesntHave('payments', function ($q) {
                #paga as mensalidades até o mes atual
                return $q->where('pago', false)
                    ->where('data_final', '<', Carbon::now());
            });
        }        

        return view('registrations.index')
            ->with('registrations', $registrations->paginate(15))
            ->with('courses', Course::All());
    }

    public function create()
    {
        return view('registrations.create')
            ->with('courses', Course::All())
            ->with('students', Student::All());
    }

    public function store(RegistrationRequest $request)
    {
        $course = Course::find($request->course_id);
        $mesmoperiodo = Registration::where('student_id', $request->student_id)
            ->where('ano', $request->ano)
            ->whereHas('course', function ($q) use ($course) {
                return $q->where('periodo', $course->periodo);
            })
            ->count();
        if ($mesmoperiodo) {
            throw ValidationException::withMessages([
                'student_id' => 'O aluno já está matriculado em outro curso no mesmo período este ano.',
            ]);
        }

        $registration = Registration::create($request->all());
        $data = Carbon::now();
        Payment::create([
            'nome'            => 'Matrícula',
            'valor'           => $course->valor_matricula,
            'data_final'      => $data,
            'registration_id' => $registration->id,
        ]);
        for ($i = 1; $i <= $course->duracao; $i++) {
            Payment::create([
                'nome'            => 'Mensalidade '.$i.'/'.$course->duracao,
                'valor'           => $course->mensalidade,
                'data_final'      => $data,
                'registration_id' => $registration->id,
            ]);
            $data->addMonth();
        }

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Matrícula salva com sucesso.');
    }

    public function show(Registration $registration)
    {
        return view('registrations.show')
            ->with('registration', $registration);
    }

    public function delete(Registration $registration)
    {
        return view('registrations.delete')
        ->with('registration', $registration);
    }

    public function destroy(Request $request, Registration $registration)
    {
        $registration->data_cancelamento = Carbon::now();
        $registration->save();

        $pendente = $registration->payments()
            ->where('pago', false)
            ->where('nome', '!=', 'Matrícula')
            ->get();
        $valor_pendente = $pendente->sum('valor');
        if ($valor_pendente) {
            foreach ($pendente as $pagamento) {
                $pagamento->delete();
            }
            # multa de 1% para cada mes nao cumprido
            Payment::create([
                'nome' => 'Multa de Cancelamento',
                'valor' => $valor_pendente * 0.01,
                'data_final' => Carbon::now(),
                'registration_id' => $registration->id,
            ]);
        }

        return redirect()
            ->route('registrations.show', $registration)
            ->with('success', 'Matrícula cancelada com sucesso.');
    }
}
