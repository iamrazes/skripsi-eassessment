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

use App\Http\Controllers\ExamController;
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

});

Route::middleware(['auth', 'can:teacher-access'])->prefix('teacher')->name('teacher.')->group(function () {
    Route::resource('exams', ExamController::class);
    Route::get('exams/{exam}/questions', [ExamController::class, 'questionsIndex'])->name('exams.questions.index');
    Route::get('exams/{exam}/questions/create', [ExamController::class, 'questionsCreate'])->name('exams.questions.create');
    Route::post('exams/{exam}/questions', [ExamController::class, 'questionsStore'])->name('exams.questions.store');
    Route::get('exams/{exam}/questions/{question}/edit', [ExamController::class, 'questionsEdit'])->name('exams.questions.edit');
    Route::put('exams/{exam}/questions/{question}', [ExamController::class, 'questionsUpdate'])->name('exams.questions.update');
    Route::delete('exams/{exam}/questions/{question}', [ExamController::class, 'questionsDestroy'])->name('exams.questions.destroy');
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

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
