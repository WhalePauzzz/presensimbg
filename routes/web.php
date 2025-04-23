<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AttendanceController;
use App\Http\Controllers\ClassesController;
use App\Http\Controllers\MbgController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\UserController;

Route::get('/', function () {
    return view('auth.login');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/dashboard', [StudentController::class, 'index'])->name('dashboard');

    Route::get('/classes', [ClassesController::class, 'index'])->name('clas.index');
});

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

Route::middleware(['auth'])->group(function () {
    Route::middleware(['auth', 'role:guru'])->group(function () {
        Route::get('/mbgs', [MbgController::class, 'index'])->name('mbgs.index');
        Route::get('/mbgs/create', [MbgController::class, 'create'])->name('mbgs.create');
        Route::post('/mbgs/store-date', [MbgController::class, 'storeDate'])->name('mbgs.storeDate');
        Route::post('/mbgs', [MbgController::class, 'store'])->name('mbgs.store');
        Route::get('/mbgs/inputFoto/{mbg}', [MbgController::class, 'inputFoto'])->name('mbgs.inputFoto');
        Route::post('/mbgs/storeFoto/{mbg}', [MbgController::class, 'storeFoto'])->name('mbgs.storeFoto');
        Route::post('/mbgs/update-status', [MbgController::class, 'updateStatus'])->name('mbgs.updateStatus');
        Route::get('/mbgs/edit/{date}', [MbgController::class, 'editByDate'])->name('mbgs.editByDate');
        Route::post('/mbgs/updateByDate', [MbgController::class, 'updateByDate'])->name('mbgs.updateByDate');
        
        Route::get('/attendance', [AttendanceController::class, 'index'])->name('attendance.index');
        Route::get('/attendance/create', [AttendanceController::class, 'create'])->name('attendance.create');
        Route::post('/attendance/store', [AttendanceController::class, 'store'])->name('attendance.store');
        Route::get('/students/{id_kelas}', [AttendanceController::class, 'getStudentsByClass']);
        Route::get('/attendance/{id}', [AttendanceController::class, 'show'])->name('attendance.show');
    });

    Route::middleware(['auth', 'role:admin'])->group(function () {
        Route::get('/user', [UserController::class, 'index'])->name('user.index');
        Route::get('/user/create', [UserController::class, 'create'])->name('user.create');
        Route::post('/user', [UserController::class, 'store'])->name('user.store');
        Route::post('/user/edit', [UserController::class, 'edit'])->name('user.edit');
        Route::post('/user/destroy', [UserController::class, 'destroy'])->name('user.destroy');

        Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
        Route::post('/students/store', [StudentController::class, 'store'])->name('students.store');
        Route::get('/students/{id}', [StudentController::class, 'show'])->name('students.show');


        
        Route::get('/classes/create', [ClassesController::class, 'create'])->name('clas.create');
        Route::post('/classes', [ClassesController::class, 'store'])->name('clas.store');
    });
    
});
require __DIR__.'/auth.php';