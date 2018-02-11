<?php

namespace App\Http\Controllers;

use App\Http\Requests\StudentRequest;
use App\Student;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index()
    {
        return view('students.index')
            ->with('students', Student::paginate(15));
    }

    public function create()
    {
        return view('students.create');
    }

    public function store(StudentRequest $request)
    {
        Student::create($request->all());

        return redirect()
        ->route('students.index')
        ->with('success', 'Aluno salvo com sucesso.');
    }

    public function edit(Student $student)
    {
        return view('students.edit')
        ->with('student', $student);
    }

    public function update(StudentRequest $request, Student $student)
    {
        $student->update($request->all());

        return redirect()
        ->route('students.index')
        ->with('success', 'Aluno alterado com sucesso.');
    }

    public function delete(Student $student)
    {
        return view('students.delete')
        ->with('student', $student);
    }

    public function destroy(Request $request, Student $student)
    {
        $student->delete();

        return redirect()
        ->route('students.index')
        ->with('success', 'Aluno excluído com sucesso.');
    }

    public function api(Request $request) {
        $students = Student::where('nome', 'like', $request->search.'%')
            ->take(100)
            ->get();

        return [
            'results' => $students->map(function($s) {
                return [
                    'id' => $s->id,
                    'text' => $s->nome,
                ];
            }),
            'pagination' => [
                'more' => false,
            ],
        ];
    }
}
