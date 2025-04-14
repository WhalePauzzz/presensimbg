<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\MbgController;
use App\Http\Controllers\StudentController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');

Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
Route::get('/students/{id_kelas}', [AttendanceController::class, 'getStudentsByClass']);
Route::get('/attendance/{id}', [AttendanceController::class, 'show'])->name('attendance.show');

Route::get('/classes', [ClassesController::class, 'index'])->name('clas.index');
Route::get('/classes/create', [ClassesController::class, 'create'])->name('clas.create');
Route::post('/classes', [ClassesController::class, 'store'])->name('clas.store');

Route::get('/mbgs', [MbgController::class, 'index'])->name('mbgs.index');
Route::get('/mbgs/create', [MbgController::class, 'create'])->name('mbgs.create');
Route::post('/mbgs/store-date', [MbgController::class, 'storeDate'])->name('mbgs.storeDate');
Route::post('/mbgs', [MbgController::class, 'store'])->name('mbgs.store');
Route::get('/mbgs/inputFoto/{mbg}', [MbgController::class, 'inputFoto'])->name('mbgs.inputFoto');
Route::post('/mbgs/storeFoto/{mbg}', [MbgController::class, 'storeFoto'])->name('mbgs.storeFoto');
Route::post('/mbgs/update-status', [MbgController::class, 'updateStatus'])->name('mbgs.updateStatus');

require __DIR__.'/auth.php';