<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Teachers;

class TeacherController extends Controller {
    public function newTeacher(Request $request) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $teacher = new Teachers;
        $teacher->firstname = $request['firstname'];
        $teacher->surname = $request['surname'];
        $teacher->save();
        return redirect('/teachers');
    }
}