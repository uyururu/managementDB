<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ClassModel;
use App\Models\User;
use App\Models\AssignClassModel;
use Auth;

class AssignClassController extends Controller
{
    //
    public function list(Request $request)
    {
        $data['getRecord'] = AssignClassModel::getRecord();
        $data['header_title'] = "Asign Class for Teacher";
        return view('admin.assign_class.list', $data);
    }
    public function add(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getTeacher'] = User::getTeacherClass();
        $data['header_title'] = "Assign Class Add";
        return view('admin.assign_class.add', $data);
    }
    public function insert(Request $request)
    {
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = AssignClassModel::countAlready($request->class_id, $teacher_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $save = new AssignClassModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/assign_class/list')->with('success', 'Asign Class Successfully');
        } else {
            return redirect('')->back()->with('error', 'Asign Class Failed');
        }
    }
    public function edit($id)
    {
        $getRecord = AssignClassModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            $data['getAssignSubjectID'] = AssignClassModel::getAssignClassID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = "Edit Asign Subject";
            return view('admin.assign_class.edit', $data);
        } else {
            abort(404);
        }
    }
    public function update($id, Request $request)
    {
        AssignClassModel::deleteClass($request->class_id);
        if (!empty($request->teacher_id)) {
            foreach ($request->teacher_id as $teacher_id) {
                $getAlreadyFirst = AssignClassModel::countAlready($request->class_id, $teacher_id);
                if (!empty($getAlreadyFirst)) {
                    $getAlreadyFirst->status = $request->status;
                    $getAlreadyFirst->save();
                } else {
                    $save = new AssignClassModel;
                    $save->class_id = $request->class_id;
                    $save->teacher_id = $teacher_id;
                    $save->status = $request->status;
                    $save->created_by = Auth::user()->id;
                    $save->save();
                }
            }
            return redirect('admin/assign_class/list')->with('success', 'Asign Subject Successfully');
        }
    }
    public function edit_single($id)
    {
        $getRecord = AssignClassModel::getSingle($id);
        if (!empty($getRecord)) {
            $data['getRecord'] = $getRecord;
            // $data['getAssignSubjectID'] = AssignClassModel::getAssignClassID($getRecord->class_id);
            $data['getClass'] = ClassModel::getClass();
            $data['getTeacher'] = User::getTeacherClass();
            $data['header_title'] = "Edit Asign Subject";
            return view('admin.assign_class.edit_single', $data);
        } else {
            abort(404);
        }
    }
    public function update_single($id, Request $request)
    {
        $getAlreadyFirst = AssignClassModel::countAlready($request->class_id, $request->teacher_id);
        if (!empty($getAlreadyFirst)) {
            $getAlreadyFirst->status = $request->status;
            $getAlreadyFirst->save();
            return redirect('admin/assign_class/list')->with('success', 'Status Successfully');
        } else {
            $save = AssignClassModel::getSingle($id);
            $save->class_id = $request->class_id;
            $save->teacher_id = $request->teacher_id;
            $save->status = $request->status;
            $save->save();
            return redirect('admin/assign_class/list')->with('success', 'Asign Class Successfully');
        }

    }
    public function delete($id)
    {
        $save = AssignClassModel::getSingle($id);
        $save->is_delete = 1;
        $save->save();
        return redirect()->back()->with('success', ' Successfully Deleted');
    }
    public function MyClassSubject()
    {
        $data['getRecord'] = AssignClassModel::getMyClassSubject(Auth::user()->id);
        $data['header_title'] = "My Class & Subject";
        return view('teacher.my_class_subject', $data);
    }
}
