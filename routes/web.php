<?php


use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\DashboardControllers;



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



Route::get('check/login/{email}',[UserController::class,'checklogin'])->name('user.check.login');
Route::prefix('admin')->group(function () {
    Route::resource('dashboard',DashboardControllers::class)->middleware('auth');
    Route::post('/dashboard/ajax',[DashboardControllers::class, 'getAjax'])->name('admin.dashboard.ajax')->middleware('auth');
});

require __DIR__.'/auth.php';
