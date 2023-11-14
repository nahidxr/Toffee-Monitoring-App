<?php

use App\Http\Controllers\ChannelCheckController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CnameController;
use App\Http\Controllers\CprofileController;
use App\Http\Controllers\DashboardController;



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


 Route::get('/', [DashboardController::class, 'index']);

// channel name
Route::get('/channel_name', [CnameController::class, 'index']);
Route::get('/channel_name/create', [CnameController::class, 'create']);
Route::post('/channel_name', [CnameController::class, 'store']);
Route::get('/channel_name/{id}/edit', [CnameController::class, 'edit']);
Route::put('/channel_name/{id}', [CnameController::class, 'update']);
Route::delete('/channel_name/{id}', [CnameController::class, 'destroy']);


// channel profile

Route::get('/channel_profile', [CprofileController::class, 'index']);
Route::get('/channel_profile/create', [CprofileController::class, 'create']);
Route::post('/channel_profile', [CprofileController::class, 'store']);
Route::get('/channel_profile/{id}/edit', [CprofileController::class, 'edit']);
Route::put('/channel_profile/{id}', [CprofileController::class, 'update']);
Route::delete('/channel_profile/{id}', [CprofileController::class, 'destroy']);

//channel checking
Route::get('/channel_checking', [ChannelCheckController::class, 'index']);


