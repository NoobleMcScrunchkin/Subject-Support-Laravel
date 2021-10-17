<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Students;

class StudentController extends Controller {
    public function newStudent(Request $request) {
        if (!Auth::user()->can('canCreateStudents')) {
            return redirect('/');
        }
        $student = new Students;
        $student->firstname = $request['firstname'];
        $student->surname = $request['surname'];
        $student->save();
        return redirect('/students');
    }

    public function editStudent(Request $request, $id) {
        if (!Auth::user()->can('canCreateStudents')) {
            return redirect('/');
        }
        $student = Students::find($id);
        $student->firstname = $request['firstname'];
        $student->surname = $request['surname'];
        $student->save();
        return redirect('/students');
    }

    public function deleteStudent(Request $request, $id) {
        if (!Auth::user()->can('canCreateStudents')) {
            return redirect('/');
        }
        $student = Students::find($id);
        if ($student) {
            $student->delete();
        }
        return redirect('/students');
    }
}