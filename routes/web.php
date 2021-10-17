<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\StudentController;
use App\Models\Students;
use App\Models\Teachers;

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

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::get('/students', function () {
    if (!Auth::user()->can('canViewStudents')) {
        return redirect('/');
    }
    return view('students', [ 'students' => Students::all()->sortBy('firstname')->sortBy('surname') ]);
})->middleware(['auth'])->name('students');

Route::get('/teachers', function () {
    if (!Auth::user()->can('canViewTeachers')) {
        return redirect('/');
    }
    return view('teachers', [ 'teachers' => Teachers::all() ]);
})->middleware(['auth'])->name('teachers');

Route::get('/newTeacher', function () {
    if (!Auth::user()->can('canCreateTeachers')) {
        return redirect('/');
    }
    return view('newTeacher');
})->middleware(['auth'])->name('newTeacher');

Route::post('/newTeacher', [TeacherController::class, 'newTeacher']);

Route::get('/newStudent', function () {
    if (!Auth::user()->can('canCreateStudents')) {
        return redirect('/');
    }
    return view('newStudent');
})->middleware(['auth'])->name('newStudent');

Route::get('/editStudent/{id}', function ($id) {
    if (!Auth::user()->can('canCreateStudents')) {
        return redirect('/');
    }
    $student = Students::find($id);
    if (!$student) {
        return redirect('/students');
    }
    return view('newStudent', ['student' => $student]);
})->middleware(['auth'])->name('editStudent');

Route::post('/newStudent', [StudentController::class, 'newStudent']);

Route::post('/editStudent/{id}', [StudentController::class, 'editStudent']);

Route::get('/deleteStudent/{id}', [StudentController::class, 'deleteStudent']);

require __DIR__.'/auth.php';
