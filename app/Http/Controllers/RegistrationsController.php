<?php

namespace App\Http\Controllers;

use App\Course;
use App\Http\Requests\RegistrationRequest;
use App\Registration;
use App\Student;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;

class RegistrationsController extends Controller
{
    public function index(Request $request)
    {
        $registrations = Registration::query();
        if (!$request->inativa) {
            $registrations = $registrations->where('ativa', true);
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
            $registrations = $registrations->where('paga', true);
        }

        return view('registrations.index')
            ->with('registrations', $registrations->get())
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
            ->where('ativa', 1)
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

        Registration::create($request->all());

        return redirect()
            ->route('registrations.index')
            ->with('success', 'Matrícula salva com sucesso.');
    }

    public function show(Registration $registration) {
        return view('registrations.show')
            ->with('registration', $registration);
    }
}
