<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Str;

class TeacherController extends Controller
{
    //
    public function list()
    {
        $data['getRecord'] = User::getTeacher();
        $data['header_title'] = 'Teacher List';
        return view('admin.teacher.list', $data);
    }
    public function add()
    {
        $data['header_title'] = 'Add New Teacher';
        return view('admin.teacher.add', $data);
    }
    public function insert(Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users',
            'mobile_number' => 'max:15|min:8',
        ]);
        $teacher = new User;
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $teacher->profile_pic = $filename;
        }
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->email = trim($request->email);
        $teacher->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if (!empty($request->date_of_joining)) {
            $teacher->date_of_joining = trim($request->date_of_joining);
        }
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        $teacher->password = Hash::make($request->password);
        $teacher->user_type = 2;
        $teacher->save();
        return redirect('admin/teacher/list')->with('success', 'Student Successfully Created');
    }
    public function edit($id)
    {
        $data['getRecord'] = User::getSingle($id);
        if (!empty($data['getRecord'])) {
            // $data['getClass'] = ClassModel::getClass();
            $data['header_title'] = 'Add New Student';
            return view('admin.teacher.edit', $data);
        } else {
            abort(404);
        }
    }
    public function update($id, Request $request)
    {
        request()->validate([
            'email' => 'required|email|unique:users,email,' . $id,
            'weight' => 'max:10',
            'blood_group' => 'max:10',
            'mobile_number' => 'max:15|min:8',
            'admission_number' => 'max:50',
            'roll_number' => 'max:50',
            'caste' => 'max: 50',
            'religion' => 'max:50',
            'height' => 'max:10',
        ]);
        $teacher = User::getSingle($id);
        if (!empty($request->file('profile_pic'))) {
            $ext = $request->file('profile_pic')->getClientOriginalExtension();
            $file = $request->file('profile_pic');
            $randomStr = date('Ymdhis') . Str::random(20);
            $filename = strtolower($randomStr) . '.' . $ext;
            $file->move('upload/profile/', $filename);
            $teacher->profile_pic = $filename;
        }
        $teacher->name = trim($request->name);
        $teacher->last_name = trim($request->last_name);
        $teacher->email = trim($request->email);
        $teacher->gender = trim($request->gender);
        if (!empty($request->date_of_birth)) {
            $teacher->date_of_birth = trim($request->date_of_birth);
        }
        if (!empty($request->date_of_joining)) {
            $teacher->date_of_joining = trim($request->date_of_joining);
        }
        $teacher->mobile_number = trim($request->mobile_number);
        $teacher->marital_status = trim($request->marital_status);
        $teacher->address = trim($request->address);
        $teacher->permanent_address = trim($request->permanent_address);
        $teacher->qualification = trim($request->qualification);
        $teacher->work_experience = trim($request->work_experience);
        $teacher->note = trim($request->note);
        $teacher->status = trim($request->status);
        if (!empty($request->password)) {
            $teacher->password = Hash::make($request->password);
        }
        $teacher->save();
        return redirect('admin/teacher/list')->with('success', 'Student Successfully Created');
    }
    public function delete($id)
    {
        $getRecord = User::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', 'Subject Successfully Deleted');
        } else {
            abort(404);
        }

    }
}
