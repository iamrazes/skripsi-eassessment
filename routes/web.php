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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

Route::middleware(['auth'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'show'])->name('profile');
});


Route::middleware(['auth', 'can:student-access'])->prefix('students')->name('students.')->group(function () {

    // Route::get('/assessments', [DashboardStudentController::class, 'assessments'])->name('assessments');
    // Route::get('/results', [DashboardStudentController::class, 'results'])->name('results');
});

Route::middleware(['auth', 'can:teacher-access'])->prefix('teacher')->name('teacher.')->group(function () {

    Route::resource('/assessments/exams', ExamController::class);

    // Route::get('/create-assessment', [DashboardTeacherController::class, 'create'])->name('create-assessment');
    // Route::get('/examine-assessment', [DashboardTeacherController::class, 'examine'])->name('examine-assessment');
    // Route::get('/review-assessment', [DashboardTeacherController::class, 'review'])->name('review-assessment');
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
