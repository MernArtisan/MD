<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Artisan;
use App\Http\Controllers\web\AuthController;
use App\Http\Controllers\web\PropertyController;


Route::get('/clear', function () {
    Artisan::call('cache:clear');
    Artisan::call('config:clear');
    Artisan::call('route:clear');
    Artisan::call('view:clear');
    Artisan::call('config:cache');
    Artisan::call('optimize:clear');

    return "<h4 style='color:green;'>✅ All caches cleared!</h4>
            <a href='javascript:history.back()'>
                <i class='fa fa-angle-left'></i> Go Back
            </a>";
});

Route::get('/', function () {
    return view('login');
})->middleware('guest')->name('login');

Route::post('/login', [AuthController::class, 'login'])->middleware('guest')->name('login.submit');
Route::post('/logout', [AuthController::class, 'logout'])->middleware('auth')->name('logout');

Route::get('change_password', function () {
    return view('changepassword');
})->middleware('auth')->name('password');


Route::prefix('property')->middleware('auth')->group(function () {
    Route::get('/profile', function () {
        return view('profile.show');
    })->name('profile');

    Route::get('/profile/edit', function () {
        return view('profile.edit');
    })->name('profile.edit');

    Route::get('/', [PropertyController::class, 'index'])->name('property');
    Route::get('/add', [PropertyController::class, 'add'])->name('show_add_form');
    Route::post('/add-submit', [PropertyController::class, 'add_property'])->name('add_property');
    Route::get('/{id}/edit', [PropertyController::class, 'edit'])->name('edit_property');
    Route::put('/{id}', [PropertyController::class, 'update'])->name('update_property');
    Route::get('/{id}/details', [PropertyController::class, 'detail'])->name('details');
    Route::get('/report', [PropertyController::class, 'reports'])->name('report');
    Route::delete('/delete/{id}', [PropertyController::class, 'destroy'])->name('delete_property');
    Route::get('/discount', [PropertyController::class, 'discount'])->name('discount');
    Route::get('/list', [PropertyController::class, 'list'])->name('list');
    Route::put('/profile/update', [PropertyController::class, 'profile_edit'])->name('profile_update');
    Route::post('/password/reset', [AuthController::class, 'resetPassword'])->name('password.reset');
    Route::get('calendar', [PropertyController::class, 'calender'])->name('calender'); // or calendar
    Route::get('calendar/properties', [PropertyController::class, 'fetchProperties'])->name('calendar.properties');
    // Route to get all available dates in a given month/year
    Route::get('/calendar/available-dates', [PropertyController::class, 'getAvailableDates']);
    Route::delete('remove-image', [PropertyController::class, 'removeImage'])->name('remove.image');
    
    Route::put('{property}/apply-discount', [PropertyController::class, 'applyDiscount'])
    ->name('property.discount');
});

Route::put('property/{property}/apply-discount', [PropertyController::class, 'applyDiscount'])
    ->name('property.discount');
