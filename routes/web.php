<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::as('home')->get('/', function () {
    return view('main');
});

Route::prefix('alunos')->as('students.')->group(function () {
    Route::get('/', 'StudentsController@index')->name('index');
    Route::get('/criar', 'StudentsController@create')->name('create');
    Route::get('{student}/editar', 'StudentsController@edit')->name('edit');
    Route::get('{student}/deletar', 'StudentsController@delete')->name('delete');
    Route::post('/', 'StudentsController@store')->name('store');
    Route::put('{student}', 'StudentsController@update')->name('update');
    Route::delete('{student}', 'StudentsController@destroy')->name('destroy');
});

Route::prefix('cursos')->as('courses.')->group(function () {
    Route::get('/', 'CoursesController@index')->name('index');
    Route::get('/criar', 'CoursesController@create')->name('create');
    Route::get('{course}/editar', 'CoursesController@edit')->name('edit');
    Route::get('{course}/deletar', 'CoursesController@delete')->name('delete');
    Route::post('/', 'CoursesController@store')->name('store');
    Route::put('{course}', 'CoursesController@update')->name('update');
    Route::delete('{course}', 'CoursesController@destroy')->name('destroy');
});

Route::prefix('matriculas')->as('registrations.')->group(function () {
    Route::get('/', 'RegistrationsController@index')->name('index');
    Route::get('/criar', 'RegistrationsController@create')->name('create');
    Route::post('/', 'RegistrationsController@store')->name('store');
});
