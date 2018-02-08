<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\RegistrationRequest;
use App\Registration;
use App\Student;
use App\Course;
use Illuminate\Validation\ValidationException;

class RegistrationsController extends Controller
{
    public function index()
    {
        return view('registrations.index')
            ->with('registrations', Registration::All());
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
            ->whereHas('course', function($q) use($course) {
                return $q->where('periodo', $course->periodo);
            })
            ->count();
        if ($mesmoperiodo) {
            throw ValidationException::withMessages([
                'student_id' => 'O aluno já está matriculado em outro curso no mesmo período este ano.'
            ]);
        }

        Registration::create($request->all());

        return redirect()
        ->route('registrations.index')
        ->with('success', 'Matrícula salva com sucesso.');
    }
}
