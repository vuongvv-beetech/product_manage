<?php
// routes/api.php
 

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiController;
use App\Http\Controllers\AuthController;
 
Route::post('login', [AuthController::class, 'login']);
Route::group([
    'prefix' => 'v1', 'middleware' => 'auth:api'
], function () {
    Route::get('info',[AuthController::class, 'profile']);
    Route::post('update',[AuthController::class, 'update']);
    Route::get('/list-product', [ApiController::class, 'allProduct']);
    Route::get('/detail-product/{id}', [ApiController::class, 'detailProduct']);
});

