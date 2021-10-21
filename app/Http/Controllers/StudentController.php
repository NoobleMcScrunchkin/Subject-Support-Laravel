<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Students;
use App\Models\Attendance;

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

    public function setAttendance(Request $request, $id) {
        $day = date('w');
        $week_start = date('d-m-Y', strtotime('-'.$day.' days'));

        $period1 = 0;
        if ($request['period1'] == "on") {
            $period1 = 1;
        }
        $period2 = 0;
        if ($request['period2'] == "on") {
            $period2 = 1;
        }

        $period1Att = Attendance::firstOrCreate([ 'students_id' => $id, 'period' => 1, 'week_commencing' => $week_start ], [ "complete" => $period1 ]);
        $period1Att->complete = $period1;
        $period1Att->save();

        $period2Att = Attendance::firstOrCreate([ 'students_id' => $id, 'period' => 2, 'week_commencing' => $week_start ], [ "complete" => $period2 ]);
        $period2Att->complete = $period2;
        $period2Att->save();
        return redirect('/');
    }
}