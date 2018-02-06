<?php

namespace App\Http\Controllers;

use App\Student;
use App\Http\Requests\StudentRequest;
use Illuminate\Http\Request;

class StudentsController extends Controller
{
    public function index() {
        return view('students.index')
            ->with('students', Student::All());
    }

    public function create() {
        return view('students.create');
    }

    public function store(StudentRequest $request) {
        Student::create($request->all());

        return redirect()
        ->route('students.index')
        ->with('success', 'Aluno salvo com sucesso.');
    }

    public function edit(Student $student) {
        return view('students.edit')
        ->with('student', $student);
    }

    public function update(StudentRequest $request, Student $student) {        
        $student->update($request->all());

        return redirect()
        ->route('students.index')
        ->with('success', 'Aluno alterado com sucesso.');
    }

    public function delete(Student $student) {
        return view('students.delete')
        ->with('student', $student);
    }

    public function destroy(Request $request, Student $student) {
        $student->delete();
        
        return redirect()
        ->route('students.index')
        ->with('success', 'Aluno excluído com sucesso.');
    }
}
