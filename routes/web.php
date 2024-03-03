<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;

use App\Http\Controllers\StudentController;

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


Route::get('/',[AdminController::class,'homeView'])->name('homeView');
Route::get('/results',[AdminController::class,'homeView'])->name('homeView');
Route::post('/results', [AdminController::class,'showResults'] )->name('results');

Route::group(['middleware' => 'guest'],function(){

    Route::get('/login',[AdminController::class,'loginview'])->name('login');
    Route::post('/login',[AdminController::class,'loginsubmit'])->name('login');

});

Route::group(['middleware' => 'auth'],function(){

    Route::get('/home',[AdminController::class,'adminHome'])->name('home');
    Route::get('/logout',[AdminController::class,'logout'])->name('logout');

    Route::get('/batch',[AdminController::class,'adminBatch'])->name('batch');
    Route::post('/create-batch', [AdminController::class, 'createBatch'])->name('createbatch');
    Route::delete('/delete/batch/{id}', [AdminController::class, 'deleteBatch'])->name('delete.batch');

    Route::get('/semester',[AdminController::class,'adminSemester'])->name('semester');
    Route::post('/create-semester', [AdminController::class, 'createSemester'])->name('createsemester');
    Route::delete('/admin/semester/{id}', [AdminController::class, 'deleteSemester'])->name('deleteSemester');

    Route::get('/subjectsAdd', [AdminController::class, 'adminSubjects'])->name('subjectsAdd');
    Route::post('/create-subjects', [AdminController::class, 'createSubjects'])->name('createsubjects');
    Route::delete('/admin/subjects/{subject}', [AdminController::class, 'deleteSubject'])->name('admin.subjects.delete');
    Route::get('/admin/subjects/{subject}/edit', [AdminController::class, 'editSubject'])->name('admin.subjects.edit');
    Route::put('/admin/subjects/{subject}', [AdminController::class, 'updateSubject'])->name('admin.subjects.update');

    Route::get('/studentregister', [StudentController::class, 'adminCreateStudent'])->name('studentregister');
    Route::post('/student-create', [StudentController::class, 'studentCreate'])->name('studentcreate');
    Route::get('/student-manage', [StudentController::class, 'showManagePage'])->name('studentmanage');
    Route::get('/search', [StudentController::class, 'search'])->name('search');
    Route::put('/students/{student}', [StudentController::class, 'studentUpdate'])->name('students.update');
    Route::delete('/student/{id}', [StudentController::class, 'delete'])->name('student.delete');

    Route::get('/subjectcombine', [AdminController::class, 'adminSubjectCombine'])->name('subjectcombine');
    Route::post('/subject-combine', [AdminController::class, 'subjectCombine'])->name('subject_combine');

    Route::get('/addresults', [StudentController::class, 'showSubjectCodes'])->name('showSubjectCodes');
    Route::post('/save-exam-results', [StudentController::class, 'saveExamResults'])->name('saveExamResults');

    Route::get('/resultsManage', [StudentController::class, 'showResultsForm'])->name('admin.resultsManage');
    Route::get('/showStudentIndex', [StudentController::class, 'showStudentIndex'])->name('show.student.index');
    Route::get('/exam-results', [StudentController::class, 'showExamResults'])->name('show.exam.results');
    Route::post('/update-marks/{id}', [StudentController::class, 'updateMarks'])->name('update.marks');
    
});