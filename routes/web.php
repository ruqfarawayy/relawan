<?php

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\FileEncryptionController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\VolunteerController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::redirect('/', 'login');

Route::prefix('admin')
    ->middleware(['auth'])
    ->group(function() {
        Route::get('/',[DashboardController::class, 'index'])
            ->name('dashboard');
        Route::resource('volunteer', VolunteerController::class);
        Route::resource('file_encryption', FileEncryptionController::class);
        Route::resource('unit', UnitController::class);
        });



require __DIR__.'/auth.php';
