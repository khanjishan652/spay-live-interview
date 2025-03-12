<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\FamilyMemberController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HeadOfFamilyController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SavedJobController;
use App\Http\Controllers\AuthController;

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

Route::match(['GET','POST'],'/', [AuthController::class, 'adminLogin'])->name('admin.login');
Route::group(['as'=>'admin.','prefix' => 'admin','middleware'=>['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::get('/logout', [AuthController::class, 'adminLogout'])->name('logout');
    Route::controller(JobController::class)->prefix('jobs')->name('jobs.')->group(function () {
        Route::get('/', 'index')->name('index');
        
    });
    Route::controller(SavedJobController::class)->prefix('saved-jobs')->name('saved-jobs.')->group(function () {
        Route::get('/', 'index')->name('index');
        
    });
    
});

