<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\JobController;
use App\Http\Controllers\SavedJobController;

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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:api')->post('/logout', [AuthController::class, 'logout']);

Route::get('/fetch-jobs', [JobController::class, 'fetchJobs']);

Route::middleware('auth:api')->group(function () {
    Route::post('/save-job', [SavedJobController::class, 'saveJob']);
    Route::delete('/delete-job/{id}', [SavedJobController::class, 'deleteJob']);
    Route::get('/saved-jobs', [SavedJobController::class, 'savedJobs']);
    Route::get('/search-jobs', [JobController::class, 'searchJobs']); // Search jobs

});
