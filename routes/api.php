<?php

use App\Http\Controllers\api\AuthController;
use App\Http\Controllers\api\DiscoverController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/


Route::get('clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('config:cache');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');

    return "All caches cleared!";
});


Route::post('login',[AuthController::class,'login'])->name('login');
Route::post('/forgot-password', [AuthController::class, 'forgotPassword']);
Route::post('/verify-otp', [AuthController::class, 'verifyOtp']);
Route::post('/reset-password', [AuthController::class, 'resetPassword']);

Route::middleware('auth:sanctum')->group(function () {
    // Route::get('/user', function (Request $request) {
    //     return $request->user(); 
    // });
    Route::post('/profile-update', [AuthController::class, 'profile']);
    Route::post('/property-add',[DiscoverController::class, 'property']);
    Route::get('/property-get', [DiscoverController::class, 'index']);
    Route::get('/property-show/{id}', [DiscoverController::class, 'show']);
    Route::post('/property-update/{id}', [DiscoverController::class, 'update']);
    Route::delete('/property-delete/{id}', [DiscoverController::class, 'delete']);
    Route::post('logout', [AuthController::class, 'logout']);

    Route::delete('delete-image/{id}', [DiscoverController::class, 'DeleteImage']);

});
