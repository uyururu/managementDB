<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use App\Models\ExamModel;
use App\Models\ClassModel;
use App\Models\ClassSubjectModel;
use App\Models\ExamScheduleModel;
use App\Models\AssignClassModel;
use App\Models\MarksRegisterModel;


class ExaminationsController extends Controller
{
    public function exam_list()
    {
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = 'Exam List';
        return view('admin.examinations.exam.list', $data);
    }
    public function exam_add()
    {
        $data['getRecord'] = ExamModel::getRecord();
        $data['header_title'] = 'Add New Exam';
        return view('admin.examinations.exam.add', $data);
    }
    public function exam_insert(Request $request)
    {
        $exam = new ExamModel;
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->created_by = Auth::user()->id;
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', 'Exam successfully created !');
    }
    public function exam_edit($id)
    {
        $data['getRecord'] = ExamModel::getSingle($id);
        if (!empty($data['getRecord'])) {
            $data['header_title'] = ' Edit Exam';
            return view('admin.examinations.exam.edit', $data);
        } else {
            abort(404);
        }

    }
    public function exam_update($id, Request $request)
    {
        $exam = ExamModel::getSingle($id);
        $exam->name = trim($request->name);
        $exam->note = trim($request->note);
        $exam->save();
        return redirect('admin/examinations/exam/list')->with('success', 'Exam successfully updated !');
    }
    public function exam_delete($id)
    {
        $getRecord = ExamModel::getSingle($id);
        if (!empty($getRecord)) {
            $getRecord->is_delete = 1;
            $getRecord->save();
            return redirect()->back()->with('success', 'Exam successfully deleted !');
        } else {
            abort(404);
        }
    }
    // exam_schedule
    public function exam_schedule(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();

        $result = array();
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) {
            $getSubject = ClassSubjectModel::MySubject($request->get('class_id'));
            foreach ($getSubject as $value) {
                $dataS = array();
                $dataS['subject_id'] = $value->subject_id;
                $dataS['class_id'] = $value->class_id;
                $dataS['subject_name'] = $value->subject_name;
                $dataS['subject_type'] = $value->subject_type;

                $ExamSchudule = ExamScheduleModel::getRecordSingle($request->get('exam_id'), $request->get('class_id'), $value->subject_id);
                if (!empty($ExamSchudule)) {
                    $dataS['exam_date'] = $ExamSchudule->exam_date;
                    $dataS['start_time'] = $ExamSchudule->start_time;
                    $dataS['end_time'] = $ExamSchudule->end_time;
                    $dataS['room_number'] = $ExamSchudule->room_number;
                    $dataS['full_marks'] = $ExamSchudule->full_marks;
                    $dataS['passing_mark'] = $ExamSchudule->passing_mark;

                } else {
                    $dataS['exam_date'] = '';
                    $dataS['start_time'] = '';
                    $dataS['end_time'] = '';
                    $dataS['room_number'] = '';
                    $dataS['full_marks'] = '';
                    $dataS['passing_mark'] = '';

                }
                $result[] = $dataS;
            }
        }
        $data['getRecord'] = $result;


        $data['header_title'] = 'Exam Schedule';
        return view('admin.examinations.exam_schedule', $data);
    }
    public function exam_schedule_insert(Request $request)
    {
        if (!empty($request->schedule)) {
            foreach ($request->schedule as $schedule) {
                if (
                    !empty($schedule['subject_id']) && !empty($schedule['exam_date'])
                    && !empty($schedule['start_time']) && !empty($schedule['end_time'])
                    && !empty($schedule['room_number']) && !empty($schedule['full_marks']) && !empty($schedule['passing_mark'])
                ) {
                    $exam = new ExamScheduleModel;
                    $exam->exam_id = $request->exam_id;
                    $exam->class_id = $request->class_id;
                    $exam->subject_id = $schedule['subject_id'];
                    $exam->exam_date = $schedule['exam_date'];
                    $exam->start_time = $schedule['start_time'];
                    $exam->end_time = $schedule['end_time'];
                    $exam->room_number = $schedule['room_number'];
                    $exam->full_marks = $schedule['full_marks'];
                    $exam->passing_mark = $schedule['passing_mark'];
                    $exam->created_by = Auth::user()->id;
                    $exam->save();
                }
            }
            return redirect()->back()->with('success', 'Exam Schedule successfully saved');
        }
    }
    // exam timetable of student    
    public function MyExamTimetable(Request $request)
    {

        $class_id = Auth::user()->class_id;
        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_marks'] = $valueS->full_marks;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;

            }

            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        // dd($result);
        $data['header_title'] = 'My Exam Timetable';
        return view('student.my_exam_timetable', $data);
    }
    // teacher side work
    public function MyExamTimetableTeacher()
    {
        $result = array();
        $getClass = AssignClassModel::getMyClassSubjectGroup(Auth::user()->id);

        foreach ($getClass as $class) {
            $dataC = array();
            $dataC['class_name'] = $class->class_name;

            $getExam = ExamScheduleModel::getExam($class->class_id);
            $examArray = array();
            foreach ($getExam as $exam) {
                $dataE = array();
                $dataE['exam_name'] = $exam->exam_name;
                $getExamTimetable = ExamScheduleModel::getExamTimetable($exam->exam_id, $class->class_id);
                $subjectArray = array();
                foreach ($getExamTimetable as $valueS) {
                    $dataS = array();
                    $dataS['subject_name'] = $valueS->subject_name;
                    $dataS['exam_date'] = $valueS->exam_date;
                    $dataS['start_time'] = $valueS->start_time;
                    $dataS['end_time'] = $valueS->end_time;
                    $dataS['room_number'] = $valueS->room_number;
                    $dataS['full_marks'] = $valueS->full_marks;
                    $dataS['passing_mark'] = $valueS->passing_mark;
                    $subjectArray[] = $dataS;

                }
                $dataE['subject'] = $subjectArray;
                $examArray[] = $dataE;
            }

            $dataC['exam'] = $examArray;
            $result[] = $dataC;


        }
        $data['getRecord'] = $result;
        $data['header_title'] = 'My Exam Timetable Teacher';
        return view('teacher/my_exam_timetable', $data);

    }
    // parent
    public function ParentMyExamTimetable($student_id)
    {
        $getStudent = User::getSingle($student_id);
        $class_id =  $getStudent->class_id;
        $getExam = ExamScheduleModel::getExam($class_id);
        $result = array();
        foreach ($getExam as $value) {
            $dataE = array();
            $dataE['name'] = $value->exam_name;
            $getExamTimetable = ExamScheduleModel::getExamTimetable($value->exam_id, $class_id);
            $resultS = array();
            foreach ($getExamTimetable as $valueS) {
                $dataS = array();
                $dataS['subject_name'] = $valueS->subject_name;
                $dataS['exam_date'] = $valueS->exam_date;
                $dataS['start_time'] = $valueS->start_time;
                $dataS['end_time'] = $valueS->end_time;
                $dataS['room_number'] = $valueS->room_number;
                $dataS['full_marks'] = $valueS->full_marks;
                $dataS['passing_mark'] = $valueS->passing_mark;
                $resultS[] = $dataS;

            }

            $dataE['exam'] = $resultS;
            $result[] = $dataE;
        }
        $data['getRecord'] = $result;
        // dd($result);
        $data['header_title'] = 'My Exam Timetable';
        return view('parent.my_exam_timetable', $data);
    }
    // marks_register
    public function marks_register(Request $request)
    {
        $data['getClass'] = ClassModel::getClass();
        $data['getExam'] = ExamModel::getExam();
        
        if (!empty($request->get('exam_id')) && !empty($request->get('class_id'))) 
        {
            $data['getSubject'] = ExamScheduleModel::getSubject($request->get('exam_id'), $request->get('class_id'));
            $data['getStudent'] = User::getStudentClass($request->get('class_id'));

        }

        $data['header_title'] = 'Exam Schedule';
        return view('admin.examinations.marks_register', $data);
    }

    public function submit_marks_register(Request $request)
    {   
        if(!empty($request->mark))
        {
            foreach($request->mark as $mark)
            {
                $class_work     = !empty($mark['class_work']) ? $mark['class_work'] : 0 ;
                $home_work      = !empty($mark['home_work']) ? $mark['home_work'] : 0 ;
                $test_work      = !empty($mark['test_work']) ? $mark['test_work'] : 0 ;
                $exam           = !empty($mark['exam']) ? $mark['exam'] : 0 ;

                // save
                $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id, $request->exam_id, 
                                                $request->class_id,  $mark['subject_id']);
                if(!empty( $getMark ))
                {
                    $save = $getMark;
                }else{
                    $save = new MarksRegisterModel;
                    $save->created_by   =   Auth::user()->id;

                }
                $save->student_id   =   $request->student_id;
                $save->class_id     =   $request->class_id;
                $save->exam_id      =   $request->exam_id;
                $save->subject_id   =   $mark['subject_id'];
                $save->class_work   =   $class_work;
                $save->home_work    =   $home_work;
                $save->test_work    =   $test_work;
                $save->exam         =   $exam;
                $save->save();

            }
        }
        $json['message'] = "Mark Register Successfully saved";
        echo json_encode($json);
    }
    public function single_submit_marks_register(Request $request)
    {
        $class_work     = !empty($request->class_work ? $request->class_work : 0);
        $home_work      = !empty($request->home_work ? $request->home_work : 0);
        $test_work      = !empty($request->test_work ? $request->test_work : 0);
        $exam           = !empty($request->exam ? $request->exam : 0);
        // save
        $getMark = MarksRegisterModel::CheckAlreadyMark($request->student_id, $request->exam_id, 
                                                $request->class_id,  $request->subject_id);
                if(!empty( $getMark ))
                {
                    $save = $getMark;
                }else{
                    $save = new MarksRegisterModel;
                    $save->created_by   =   Auth::user()->id;

                }
                $save->student_id   =   $request->student_id;
                $save->class_id     =   $request->class_id;
                $save->exam_id      =   $request->exam_id;
                $save->subject_id   =   $request->subject_id;
                $save->class_work   =   $class_work;
                $save->home_work    =   $home_work;
                $save->test_work    =   $test_work;
                $save->exam         =   $exam;
                $save->save();
                // 
                $json['message'] = "Mark Register Successfully saved";
                echo json_encode($json);
    }
    
    
}


