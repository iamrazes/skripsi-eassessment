<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ProfileController;

use App\Http\Controllers\UserController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\PermissionController;
use App\Http\Controllers\DataAdminController;
use App\Http\Controllers\DataTeacherController;
use App\Http\Controllers\DataStudentController;
use App\Http\Controllers\ClassroomController;
use App\Http\Controllers\ExamTypeController;
use App\Http\Controllers\SubjectController;

use App\Http\Controllers\ExamTeacherController;
use App\Http\Controllers\ExamTeacherHistoryController;
use App\Http\Controllers\ExamStudentController;
use App\Http\Controllers\ExamStudentReportController;
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

Route::get('/', function () {
    return view('welcome');
})->name('welcome');

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth'])
    ->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});

Route::middleware(['auth', 'can:student-access'])->prefix('students')->name('students.')->group(function () {
    Route::resource('exams', ExamStudentController::class);

    Route::get('exams/{exam}/question/{question}', [ExamStudentController::class, 'showQuestion'])->name('exams.show-question');
    Route::post('exams/{exam}/question/{question}/save', [ExamStudentController::class, 'saveAnswer'])->name('exams.save-answer');
    Route::post('exams/{exam}/finish', [ExamStudentController::class, 'finishExam'])->name('exams.finish');

    Route::resource('reports', ExamStudentReportController::class);
});

Route::middleware(['auth', 'can:teacher-access'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('exams', ExamTeacherController::class);

    Route::get('exams/{exam}/questions/create', [ExamTeacherController::class, 'questionsCreate'])->name('exams.questions.create');
    Route::post('exams/{exam}/questions', [ExamTeacherController::class, 'questionsStore'])->name('exams.questions.store');

    Route::post('exams/{exam}/publish', [ExamTeacherController::class, 'publish'])->name('exams.publish');
    Route::post('exams/{exam}/complete', [ExamTeacherController::class, 'complete'])->name('exams.complete');

    Route::get('history', [ExamTeacherHistoryController::class, 'index'])->name('history.index');
    Route::get('history/exam/{exam}', [ExamTeacherHistoryController::class, 'show'])->name('history.show');
    Route::get('history/exam/{exam}/edit', [ExamTeacherHistoryController::class, 'edit'])->name('history.edit');
    Route::get('history/exam/{exam}/update', [ExamTeacherHistoryController::class, 'update'])->name('history.update');

    Route::get('classrooms', [ClassroomController::class, 'teacherIndex'])->name('classrooms.teacherIndex');
    Route::get('classrooms/{classroom}', [ClassroomController::class, 'teacherShow'])->name('classrooms.teacherShow');

});

Route::middleware(['auth', 'can:admin-access'])->prefix('admin')->name('admin.')->group(function () {
    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('permissions', PermissionController::class);
    Route::resource('data-admins', DataAdminController::class);
    Route::resource('data-teachers', DataTeacherController::class);
    Route::resource('data-students', DataStudentController::class);
    Route::resource('classrooms', ClassroomController::class);
    Route::resource('exam-types', ExamTypeController::class);
    Route::resource('subjects', SubjectController::class);
});

require __DIR__.'/auth.php';
