<?php

use Illuminate\Support\Facades\Route;

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
    return view('welcome');
});

Auth::routes();
Route::middleware('auth')->group(function (){
    Route::get('/dashboard/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

    //Parent
    Route::resource('family',\App\Http\Controllers\FamilyController::class);
    Route::get('family/datatable/ssd',[\App\Http\Controllers\FamilyController::class,'ssd'])->name('family.ssd');

    //Student
    Route::resource('student',\App\Http\Controllers\StudentController::class);
    Route::get('student/datatable/ssd',[\App\Http\Controllers\StudentController::class,'ssd'])->name('student.ssd');

    //Teacher
    Route::resource('teacher',\App\Http\Controllers\TeacherController::class);
    Route::get('teacher/datatable/ssd',[\App\Http\Controllers\TeacherController::class,'ssd'])->name('teacher.ssd');

    //Grade
    Route::resource('grade',\App\Http\Controllers\GradeController::class);
    Route::get('grade/datatable/ssd',[\App\Http\Controllers\GradeController::class,'ssd'])->name('grade.ssd');

    //Course
    Route::resource('course',\App\Http\Controllers\CourseController::class);
    Route::get('course/datatable/ssd',[\App\Http\Controllers\CourseController::class,'ssd'])->name('course.ssd');

    //Classroom
    Route::resource('classroom',\App\Http\Controllers\ClassroomController::class);
    Route::get('classroom/datatable/ssd',[\App\Http\Controllers\ClassroomController::class,'ssd'])->name('classroom.ssd');



});
Route::post('/logout', [\App\Http\Controllers\HomeController::class, 'logout'])->name('logout');
