<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Students;
use App\Models\students_user;

class TeacherController extends Controller {
    public function newTeacher(Request $request) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $user = new User;
        $user->firstname = $request['firstname'];
        $user->surname = $request['surname'];
        $user->username = strtolower($request['firstname']).".".strtolower($request['surname']);
        $user->password = '$2a$12$2hJtQK2AksZxw3yKeIy10ewwajzfiYpvFw5DGk2Sjppo/Gzi5jOFC';
        $user->is_admin = 0;
        $user->save();
        $user->assignRole('Teacher');
        return redirect('/teachers');
    }

    public function editTeacher(Request $request, $id) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $teacher = User::find($id);
        if ($teacher) {
            $teacher->firstname = $request['firstname'];
            $teacher->surname = $request['surname'];
            $teacher->save();
        }
        return redirect('/teachers');
    }

    public function deleteTeacher(Request $request, $id) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $teacher = User::find($id);
        if ($teacher) {
            $teacher->delete();
        }
        return redirect('/teachers');
    }

    public function resetTeacherPass(Request $request, $id) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $teacher = User::find($id);
        if ($teacher) {
            $teacher->password = '$2a$12$2hJtQK2AksZxw3yKeIy10ewwajzfiYpvFw5DGk2Sjppo/Gzi5jOFC';
            $teacher->save();
        }
        return redirect('/teachers');
    }

    public function changePassword(Request $request) {
        $user = Auth::user();
        if (!password_verify($request['oldPassword'], $user->password)){
            return redirect('/changePassword');
        }

        if ($request['newPassword'] != $request['confirmation']) {
            return redirect('/changePassword');
        }

        $user->password = password_hash($request['newPassword'], PASSWORD_BCRYPT);
        $user->save();
        return redirect('/');
    }

    public function setTeacherStudents(Request $request, $id) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/teachers');
        }
        $students = array_unique($request->students);
        if (!User::find($id)) {
            return redirect('/teachers');
        }
        
        students_user::where('user_id', $id)->delete();

        foreach ($students as $student) {
            if (!Students::find($student)) {
                continue;
            }
            $rel = students_user::firstOrCreate([
                'students_id' => $student,
                'user_id' => $id
            ]);
        }
        return redirect('/teachers');
    }
}