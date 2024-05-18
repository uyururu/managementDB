<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ClassController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SubjectController;
use App\Http\Controllers\ClassSubjectController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ParentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\AssignClassController;
use App\Http\Controllers\ClassTimeTableController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

// Route::get('/', function () {
//     return view('welcome');
// });

// lấy giá trị "/" trên thanh taskbar và thực hiện 
// phương thức login ở AuthController 
Route::get('/', [AuthController::class, 'login']);

//chuyển hướng đến giao diện sau khi đăng nhập 
Route::post('login', [AuthController::class, 'AuthLogin']);
Route::get('logout', [AuthController::class, 'logout']);

/*
 * phương thức quên mật khẩu
 */
Route::get('forgot-password', [AuthController::class, 'forgotpassword']);
Route::post('forgot-password', [AuthController::class, 'PostForgotPassword']);
Route::get('reset/{token}', [AuthController::class, 'reset']);
Route::post('reset/{token}', [AuthController::class, 'Postreset']);


// Route::get('admin/admin/list', function () {
//     return view('admin.admin.list');
// });
// ================================================


/**
 * ================================= ADMIN ROUTE ========================================
 */
Route::group(['middleware' => 'admin'], function () {
    Route::get('admin/dashboard', [DashboardController::class, 'dashboard']);
    Route::get('admin/admin/list', [AdminController::class, 'list']);
    Route::get('admin/admin/add', [AdminController::class, 'add']);
    Route::post('admin/admin/add', [AdminController::class, 'insert']);


    Route::get('admin/admin/edit/{id}', [AdminController::class, 'edit']);
    Route::post('admin/admin/edit/{id}', [AdminController::class, 'update']);
    Route::get('admin/admin/delete/{id}', [AdminController::class, 'delete']);

    // class url
    Route::get('admin/class/list', [ClassController::class, 'list']);
    Route::get('admin/class/add', [ClassController::class, 'add']);
    Route::post('admin/class/add', [ClassController::class, 'insert']);
    Route::get('admin/class/edit/{id}', [ClassController::class, 'edit']);
    Route::post('admin/class/edit/{id}', [ClassController::class, 'update']);
    Route::get('admin/class/delete/{id}', [ClassController::class, 'delete']);

    /**
     * subject url
     */
    Route::get('admin/subject/list', [SubjectController::class, 'list']);
    Route::get('admin/subject/add', [SubjectController::class, 'add']);
    Route::post('admin/subject/add', [SubjectController::class, 'insert']);
    Route::get('admin/subject/edit/{id}', [SubjectController::class, 'edit']);
    Route::post('admin/subject/edit/{id}', [SubjectController::class, 'update']);
    Route::get('admin/subject/delete/{id}', [SubjectController::class, 'delete']);

    /**
     * Asign Subject
     */
    Route::get('admin/assign_subject/list', [ClassSubjectController::class, 'list']);
    Route::get('admin/assign_subject/add', [ClassSubjectController::class, 'add']);
    Route::post('admin/assign_subject/add', [ClassSubjectController::class, 'insert']);
    Route::get('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'edit']);
    Route::post('admin/assign_subject/edit/{id}', [ClassSubjectController::class, 'update']);
    Route::get('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'edit_single']);
    Route::post('admin/assign_subject/edit_single/{id}', [ClassSubjectController::class, 'update_single']);
    Route::get('admin/assign_subject/delete/{id}', [ClassSubjectController::class, 'delete']);

    /**
     * Asign Class
     */
    Route::get('admin/assign_class/list', [AssignClassController::class, 'list']);
    Route::get('admin/assign_class/add', [AssignClassController::class, 'add']);
    Route::post('admin/assign_class/add', [AssignClassController::class, 'insert']);
    Route::get('admin/assign_class/edit/{id}', [AssignClassController::class, 'edit']);
    Route::post('admin/assign_class/edit/{id}', [AssignClassController::class, 'update']);
    Route::get('admin/assign_class/edit_single/{id}', [AssignClassController::class, 'edit_single']);
    Route::post('admin/assign_class/edit_single/{id}', [AssignClassController::class, 'update_single']);
    Route::get('admin/assign_class/delete/{id}', [AssignClassController::class, 'delete']);

    /**
     * admin/ change password
     */
    Route::get('admin/change_password', [UserController::class, 'change_password']);
    Route::post('admin/change_password', [UserController::class, 'update_change_password']);

    /**
     * Student
     */
    Route::get('admin/student/list', [StudentController::class, 'list']);
    Route::get('admin/student/add', [StudentController::class, 'add']);
    Route::post('admin/student/add', [StudentController::class, 'insert']);
    Route::get('admin/student/edit/{id}', [StudentController::class, 'edit']);
    Route::post('admin/student/edit/{id}', [StudentController::class, 'update']);
    Route::get('admin/student/delete/{id}', [StudentController::class, 'delete']);

    /**
     * Parent
     */
    Route::get('admin/parent/list', [ParentController::class, 'list']);
    Route::get('admin/parent/add', [ParentController::class, 'add']);
    Route::post('admin/parent/add', [ParentController::class, 'insert']);
    Route::get('admin/parent/edit/{id}', [ParentController::class, 'edit']);
    Route::post('admin/parent/edit/{id}', [ParentController::class, 'update']);
    Route::get('admin/parent/delete/{id}', [ParentController::class, 'delete']);
    Route::get('admin/parent/my_relative/{id}', [ParentController::class, 'myrelative']);
    Route::get('admin/parent/assign_student/{student_id}/{parent_id}', [ParentController::class, 'assignstudent']);
    Route::get('admin/parent/assign_student_delete/{student_id}', [ParentController::class, 'assignstudentDelete']);


    /**
     * Teacher
     */
    Route::get('admin/teacher/list', [TeacherController::class, 'list']);
    Route::get('admin/teacher/add', [TeacherController::class, 'add']);
    Route::post('admin/teacher/add', [TeacherController::class, 'insert']);
    Route::get('admin/teacher/edit/{id}', [TeacherController::class, 'edit']);
    Route::post('admin/teacher/edit/{id}', [TeacherController::class, 'update']);
    Route::get('admin/teacher/delete/{id}', [TeacherController::class, 'delete']);

    /**
     * Admin count
     */
    Route::get('admin/account', [UserController::class, 'Myaccount']);
    Route::post('admin/account', [UserController::class, 'UpdateMyaccount_admin']);

    /**
     * Class Timetalbe
     */
    Route::get('admin/class_timetable/list', [ClassTimeTableController::class, 'list']);
    Route::post('admin/class_timetable/get_subject', [ClassTimeTableController::class, 'get_subject']);
    Route::post('admin/class_timetable/add', [ClassTimeTableController::class, 'insert_update']);


    // Route::get('admin/class_timetable/add', [ClassTimeTableController::class, 'add']);
    // Route::post('admin/class_timetable/add', [ClassTimeTableController::class, 'insert']);
    // Route::get('admin/class_timetable/edit/{id}', [ClassTimeTableController::class, 'edit']);
    // Route::post('admin/class_timetable/edit/{id}', [ClassTimeTableController::class, 'update']);
    // Route::get('admin/class_timetable/delete/{id}', [ClassTimeTableController::class, 'delete']);
});

/**
 * ================================= TEACHER ROUTE ========================================
 */
Route::group(['middleware' => 'teacher'], function () {
    Route::get('teacher/dashboard', [DashboardController::class, 'dashboard']);
    /**
     * teacher/ change password
     */
    Route::get('teacher/change_password', [UserController::class, 'change_password']);
    Route::post('teacher/change_password', [UserController::class, 'update_change_password']);

    /**
     * Teacher count
     */
    Route::get('teacher/account', [UserController::class, 'Myaccount']);
    Route::post('teacher/account', [UserController::class, 'UpdateMyaccount']);

    /**
     * Teacher Class - Subject
     */
    Route::get('teacher/my_class_subject', [AssignClassController::class, 'MyClassSubject']);
    Route::get('teacher/my_class_subject/class_timetable/{class_id}/{subject_id}', [ClassTimeTableController::class, 'MyTimeTableTeacher']);
    Route::post('teacher/my_class_subject', [StudentController::class, 'UpdateMyClassSubject']);

    /**
     * Student subject list
     */
    Route::get('teacher/my_student', [StudentController::class, 'MyStudent']);
    Route::post('teacher/my_student', [StudentController::class, 'MyStudent']);

});

/**
 * ================================= STUDENT ROUTE ========================================
 */
Route::group(['middleware' => 'student'], function () {
    Route::get('student/dashboard', [DashboardController::class, 'dashboard']);
    /**
     * Student/ change password
     */
    Route::get('student/change_password', [UserController::class, 'change_password']);
    Route::post('student/change_password', [UserController::class, 'update_change_password']);

    /**
     * Student account
     */
    Route::get('student/account', [UserController::class, 'Myaccount']);
    Route::post('student/account', [UserController::class, 'UpdateMyaccount_student']);

    /**
     * Student subject list
     */
    Route::get('student/my_subject', [SubjectController::class, 'MySubject']);
    Route::post('student/my_subject', [SubjectController::class, 'MySubject']);
    Route::get('student/my_timetable', [ClassTimeTableController::class, 'Mytimetable']);

    


});

/**
 * ================================= PARENT ROUTE ========================================
 */
Route::group(['middleware' => 'parent'], function () {
    Route::get('parent/dashboard', [DashboardController::class, 'dashboard']);

    /**
     * parent/ change password
     */
    Route::get('parent/change_password', [UserController::class, 'change_password']);
    Route::post('parent/change_password', [UserController::class, 'update_change_password']);

    /**
     * parent account
     */
    Route::get('parent/account', [UserController::class, 'Myaccount']);
    Route::post('parent/account', [UserController::class, 'UpdateMyaccount_parent']);

    /**
     * parent relative
     */
    Route::get('parent/my_relative', [ParentController::class, 'ParentRelative']);

    /**
     * parent relative Subject
     */
    Route::get('parent/my_relative/subject/{student_id}', [SubjectController::class, 'ParentRelativeSubject']);

});
