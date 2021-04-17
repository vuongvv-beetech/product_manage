<?php

use App\Http\Controllers\User\Auth\LoginController;
use App\Http\Controllers\User\CategoryController;
use App\Http\Controllers\User\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\User\Auth\ResetPasswordController;
use App\Http\Controllers\Admin\HomeController;
use App\Http\Controllers\User\HomeController as UserHomeController;

Route::get('/login', [LoginController::class, 'showFormLogin'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login');


Route::get('/forgot-password', [ResetPasswordController::class, 'forgotPassword'])->name('password.request');
Route::post('/request', [ResetPasswordController::class, 'sendMail'])->name('password.sendmail');
Route::get('/reset-password/{token}', [ResetPasswordController::class, 'changePass'])->name('password.reset');
Route::put('/changepassword', [ResetPasswordController::class, 'update'])->name('password.change');


Route::post('/logout',[LoginController::class,'logout'])->name('logout');
Route::middleware('auth')->prefix('category')->group(function (){
    Route::get('/', [CategoryController::class, 'index'])->name('category');
    Route::get('add',[CategoryController::class,'create'])->name('category.create');
    Route::post('store',[CategoryController::class,'store'])->name('category.store');
    Route::get('edit/{id}',[CategoryController::class,'edit'])->name('category.edit');
    Route::put('update/{id}',[CategoryController::class,'update'])->name('category.update');
    Route::delete('delete/{id}',[CategoryController::class,'destroy'])->name('category.destroy');
});
Route::middleware('auth')->prefix('product')->group(function (){
    Route::get('/', [ProductController::class, 'index'])->name('product');
    Route::get('add',[ProductController::class,'create'])->name('product.create');
    Route::post('store',[ProductController::class,'store'])->name('product.store');
    Route::get('edit/{id}',[ProductController::class,'edit'])->name('product.edit');
    Route::put('update/{id}',[ProductController::class,'update'])->name('product.update');
    Route::delete('delete/{id}',[ProductController::class,'destroy'])->name('product.destroy');
    Route::get('pdf',[ProductController::class,'exportPDF'])->name('product.exportPDF');
    Route::get('csv',[ProductController::class,'exportCSV'])->name('product.exportCSV');
    
});

Route::group(['middleware' => 'locale'], function() {
    Route::get('change-language/{locale}', [UserHomeController::class,'changeLanguage'])
        ->name('user.change-language');
});
Route::get('checkSKU',[ProductController::class,'checkSKU'])->name('product.checkSKU');