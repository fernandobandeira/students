<?php

namespace App\Http\Controllers;

use App\Http\Requests\CourseRequest;
use App\Course;
use Illuminate\Http\Request;

class CoursesController extends Controller
{
    public function index()
    {
        return view('courses.index')
            ->with('courses', Course::All());
    }

    public function create()
    {
        return view('courses.create');
    }

    public function store(CourseRequest $request)
    {
        Course::create($request->all());

        return redirect()
        ->route('courses.index')
        ->with('success', 'Curso salvo com sucesso.');
    }

    public function edit(Course $course)
    {
        return view('courses.edit')
        ->with('course', $course);
    }

    public function update(CourseRequest $request, Course $course)
    {
        $course->update($request->all());

        return redirect()
        ->route('courses.index')
        ->with('success', 'Curso alterado com sucesso.');
    }

    public function delete(Course $course)
    {
        return view('courses.delete')
        ->with('course', $course);
    }

    public function destroy(Request $request, Course $course)
    {
        $course->delete();

        return redirect()
        ->route('courses.index')
        ->with('success', 'Curso excluído com sucesso.');
    }
}
