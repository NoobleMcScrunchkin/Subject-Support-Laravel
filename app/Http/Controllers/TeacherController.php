<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use Auth;
use App\Http\Controllers\Controller;
use App\Models\Teachers;
use App\Models\User;

class TeacherController extends Controller {
    public function newTeacher(Request $request) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $teacher = new Teachers;
        $teacher->firstname = $request['firstname'];
        $teacher->surname = $request['surname'];
        $teacher->save();
        $user = new User;
        $user->name = $request['firstname']." ".$request['surname'];
        $user->username = strtolower($request['firstname']).".".strtolower($request['surname']);
        $user->password = '$2a$12$2hJtQK2AksZxw3yKeIy10ewwajzfiYpvFw5DGk2Sjppo/Gzi5jOFC';
        $user->save();
        $user->assignRole('Teacher');
        return redirect('/teachers');
    }

    public function editTeacher(Request $request, $id) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $teacher = Teachers::find($id);
        if ($teacher) {
            $teacher->firstname = $request['firstname'];
            $teacher->surname = $request['surname'];
            $teacher->save();
            $user = User::find($teacher['id']);
            if ($user) {
                $user->name = $request['firstname']." ".$request['surname'];
                $user->save();
            }
        }
        return redirect('/teachers');
    }

    public function deleteTeacher(Request $request, $id) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $teacher = Teachers::find($id);
        if ($teacher) {
            $teacher->delete();
        }
        return redirect('/teachers');
    }

    public function resetTeacherPass(Request $request, $id) {
        if (!Auth::user()->can('canCreateTeachers')) {
            return redirect('/');
        }
        $teacher = Teachers::find($id);
        if ($teacher) {
            $user = User::find($teacher['userID']);
            if ($user) {
                $user->password = '$2a$12$2hJtQK2AksZxw3yKeIy10ewwajzfiYpvFw5DGk2Sjppo/Gzi5jOFC';
                $user->save();
            }
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
}