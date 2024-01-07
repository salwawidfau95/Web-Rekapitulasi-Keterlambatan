<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RombelController;
use App\Http\Controllers\RayonController;
use App\Http\Controllers\LateController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\StudentController;


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
Route::middleware(['IsGuest'])->group(function(){
    Route::get('/',function(){
        return view('login');
    })->name('login');
        Route::post('/login-auth', [UserController::class, 'loginAuth'])->name('login.auth');
});

Route::middleware('IsLogin')->group(function() {
    Route::get('/dashboard', function () {
        return view('home.index');
    });
    Route::get('/dashboard2',[UserController::class, 'dashboard2'])->name('dashboard2');
    Route::get('/logout', [UserController::class, 'logout'])->name('logout');
});

Route::middleware('IsAdmin')->group(function() {
    Route::prefix('rombel')->name('rombel.')->group(function(){
            Route::get('/',[RombelController::class, 'index'])->name('index');
            Route::get('/create',[RombelController::class, 'create'])->name('create');
            Route::post('/store',[RombelController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[RombelController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}',[RombelController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[RombelController::class, 'destroy'])->name('delete');
    });

    Route::prefix('rayon')->name('rayon.')->group(function(){
            Route::get('/',[RayonController::class, 'index'])->name('index');
            Route::get('/create',[RayonController::class, 'create'])->name('create');
            Route::post('/store',[RayonController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[RayonController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}',[RayonController::class, 'update'])->name('update');
            Route::delete('/delete/{id}',[RayonController::class, 'destroy'])->name('delete');
    });

    Route::prefix('user')->name('user.')->group(function(){
            Route::get('/',[UserController::class, 'index'])->name('index');
            Route::get('/create',[UserController::class, 'create'])->name('create');
            Route::post('/store',[UserController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[UserController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}',[UserController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[UserController::class,'destroy'])->name('delete');
    });

    Route::prefix('late')->name('admin.late.')->group(function(){
            Route::get('/data',[LateController::class, 'data'])->name('data');
            Route::get('/rekap2',[LateController::class, 'rekap2'])->name('rekap2');
            Route::get('/show2/{id}',[LateController::class, 'show2'])->name('show2');
            Route::get('/create',[LateController::class, 'create'])->name('create');
            Route::post('/store',[LateController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[LateController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}',[LateController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[LateController::class,'destroy'])->name('delete');
            Route::get('/export-excel2', [LateController::class,'exportExcel'])->name('export-excel2');
            Route::get('/download2/{id}',[LateController::class,'download2'])->name('download2');
    });

    Route::prefix('student')->name('admin.student.')->group(function(){
            Route::get('/data',[StudentController::class, 'data'])->name('data');
            Route::get('/create',[StudentController::class, 'create'])->name('create');
            Route::post('/store',[StudentController::class, 'store'])->name('store');
            Route::get('/edit/{id}',[StudentController::class, 'edit'])->name('edit');
            Route::patch('/update/{id}',[StudentController::class,'update'])->name('update');
            Route::delete('/delete/{id}',[StudentController::class,'destroy'])->name('delete');
    });
});

Route::middleware('IsPs')->group(function() {
    Route::prefix('student')->name('ps.student.')->group(function(){
        Route::get('/',[StudentController::class, 'index'])->name('index');
    });
    Route::prefix('late')->name('ps.late.')->group(function(){
        Route::get('/',[LateController::class, 'index'])->name('index');
        Route::get('/rekap',[LateController::class, 'rekap'])->name('rekap');
        Route::get('/show/{id}',[LateController::class, 'show'])->name('show');
        Route::get('/export-excel', [LateController::class,'exportExcel'])->name('export-excel');
        Route::get('/download/{id}',[LateController::class,'downloadPDF'])->name('download');
    });
});