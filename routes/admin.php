<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\DataController;
use App\Http\Controllers\Admin\UserController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\ResetPasswordController;

// login
Route::get('/login', [LoginController::class, 'showFormLogin'])->name('admin.login');
Route::post('/login', [LoginController::class, 'login'])->name('admin.login.submit');

//send mail confirm user
Route::get('user/confirm-password/{token}',[UserController::class, 'changePass'])->name('password.confirm');
Route::put('/changepassword', [ResetPasswordController::class, 'update'])->name('password.confirmuser');

Route::post('/logout',[LoginController::class,'logout'])->name('admin.logout');

// manager user
Route::middleware('auth:admin')->group(function (){
    Route::get('/', [UserController::class, 'index'])->name('admin.index');
    Route::get('add',[UserController::class,'create'])->name('admin.create');
    Route::post('store',[UserController::class,'store'])->name('admin.store');
    Route::get('edit/{id}',[UserController::class,'edit'])->name('admin.edit');
    Route::put('update/{id}',[UserController::class,'update'])->name('admin.update');
    Route::delete('delete/{id}',[UserController::class,'destroy'])->name('user.destroy');


    // import data
    Route::get('/import', [DataController::class, 'import'])->name('admin.import');
    Route::post('/data', [DataController::class, 'store'])->name('admin.add');

    // get district, commune
    Route::get('district/{id}',[UserController::class,'getDistrict']);
    Route::get('commune/{id}',[UserController::class,'getCommune']);
});

Route::get('check',[UserController::class,'checkUser'])->name('user.get-mail');;
