<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\RoleManagementController;
use App\Http\Controllers\PenggunaController;
use App\Http\Controllers\ApprovalController;
use App\Http\Controllers\CabangController;
use App\Http\Controllers\AuditTrailController;
use App\Http\Controllers\NasabahController;
use App\Http\Controllers\ReportController;




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

// Route::get('/{id}', function () {
//     return view('nasabah.index');
// });

Route::get('/{generate}',[NasabahController::class, 'index'])->name('nasabah');

Route::prefix('admin')->group(function () {
    Route::get('/dashboard',[DashboardController::class, 'index'])->name('admin.dashboard')->middleware('auth');

    Route::resource('roles',RoleController::class)->middleware('auth');
    Route::post('/roles/ajax',[RoleController::class, 'getAjax'])->name('admin.roles.ajax')->middleware('auth');

    Route::resource('roles-management',RoleManagementController::class)->middleware('auth');
    Route::post('/roles-management/ajax',[RoleManagementController::class, 'getAjax'])->name('admin.roles-management.ajax')->middleware('auth');

    Route::resource('cabang',CabangController::class)->middleware('auth');
    Route::post('/cabang/ajax',[CabangController::class, 'getAjax'])->name('admin.cabang.ajax')->middleware('auth');

    Route::resource('pengguna',PenggunaController::class)->middleware('auth');
    Route::post('/pengguna/ajax',[PenggunaController::class, 'getAjax'])->name('admin.pengguna.ajax')->middleware('auth');

    Route::resource('approval',ApprovalController::class)->middleware('auth');
    Route::post('/approval/ajax',[ApprovalController::class, 'getAjax'])->name('admin.approval.ajax')->middleware('auth');

    Route::resource('auditTrail',AuditTrailController::class)->middleware('auth');
    Route::post('/auditTrail/ajax',[AuditTrailController::class, 'getAjax'])->name('admin.auditTrail.ajax')->middleware('auth');

    Route::resource('report',ReportController::class)->middleware('auth');
    Route::post('/report/ajax',[ReportController::class, 'getAjax'])->name('admin.report.ajax')->middleware('auth');

    Route::get('users/qrcode',[PenggunaController::class, 'viewQr'])->name('admin.users.qrcode')->middleware('auth');
    Route::post('/users/qrcode/ajax',[PenggunaController::class, 'getQrAjax'])->name('admin.users.qrcode.ajax')->middleware('auth');
    Route::get('/users/qrcode/printqrcode/{id}',[PenggunaController::class, 'printqrcode'])->name('admin.users.qrcode.printqrcode')->middleware('auth');

    
    
});

/*
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->middleware(['auth', 'verified'])->name('dashboard');
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
*/


require __DIR__.'/auth.php';
