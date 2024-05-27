<?php

use App\Http\Controllers\DashboardStudentController;
use App\Http\Controllers\DashboardTeacherController;
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
})->middleware(['auth', 'verified'])->name('dashboard');

Route::get('/profile', function () {
    return view('profile');
})->middleware(['auth', 'verified'])->name('profile');


Route::middleware(['auth', 'verified'])->prefix('students')->name('students.')->group(function () {

    Route::get('/assessments', [DashboardStudentController::class, 'assessments'])->name('assessments');
    Route::get('/results', [DashboardStudentController::class, 'results'])->name('results');
});

Route::middleware(['auth', 'verified'])->prefix('teacher')->name('teacher.')->group(function () {

    Route::get('/create-assessment', [DashboardTeacherController::class, 'create'])->name('create-assessment');
    Route::get('/examine-assessment', [DashboardTeacherController::class, 'examine'])->name('examine-assessment');
    Route::get('/review-assessment', [DashboardTeacherController::class, 'review'])->name('review-assessment');
});


// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';
