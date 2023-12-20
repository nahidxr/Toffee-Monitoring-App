<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CnameController;
use App\Http\Controllers\CprofileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChannelCheckController;
use App\Http\Controllers\SlackNotificationController;
use App\Http\Controllers\ChannelPlayingController;
use App\Http\Controllers\TestController;
use App\Models\Cprofile;



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







// Route::get('/dashboard', [DashboardController::class, 'index']);

Route::get('/dashboard', function () {
    // $data['cprofile_list'] = Cprofile::get();
    return view('admin.dashboard.index');
})->middleware(['auth', 'verified'])->name('dashboard');


// // channel name
// Route::get('/channel_name', [CnameController::class, 'index']);
// Route::get('/channel_name/create', [CnameController::class, 'create']);
// Route::post('/channel_name', [CnameController::class, 'store']);
// Route::get('/channel_name/{id}/edit', [CnameController::class, 'edit']);
// Route::put('/channel_name/{id}', [CnameController::class, 'update']);
// Route::delete('/channel_name/{id}', [CnameController::class, 'destroy']);


// // channel profile

// Route::get('/channel_profile', [CprofileController::class, 'index']);
// Route::get('/channel_profile/create', [CprofileController::class, 'create']);
// Route::post('/channel_profile', [CprofileController::class, 'store']);
// Route::get('/channel_profile/{id}/edit', [CprofileController::class, 'edit']);
// Route::put('/channel_profile/{id}', [CprofileController::class, 'update']);
// Route::delete('/channel_profile/{id}', [CprofileController::class, 'destroy']);

// //channel checking
// Route::get('/channel_checking', [ChannelCheckController::class, 'index']);
// Route::post('/send-slack-notification', [ChannelCheckController::class, 'sendInvalidSlackNotification']);
// Route::post('/send-valid-slack-notification', [ChannelCheckController::class, 'sendValidSlackNotification']);
// Route::post('/send-channel-counts', [ChannelCheckController::class, 'sendChannelCounts']);


//TestController
Route::get('/test',[TestController::class,'index']);
Route::get('post',[TestController::class,'test']);



Route::middleware('auth')->group(function () {

//channel checking
Route::get('/channel_checking', [ChannelCheckController::class, 'index']);
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

 //slacknotifiaction 
Route::post('/send-invalid-slack-notification', [SlackNotificationController::class, 'sendInvalidSlackNotification']);
Route::post('/send-valid-slack-notification', [SlackNotificationController::class, 'sendValidSlackNotification']);
Route::post('/send-channel-counts', [SlackNotificationController::class, 'sendChannelCounts']);

//dashboard
// Route::get('/dashboard', [DashboardController::class, 'index']);

//channe
Route::get('/channel_playing', [ChannelPlayingController::class, 'index']);
  
});


Route::get('/', function () {
    return view('auth.login');
});

// Route::get('/dashboard', function () {
//     return view('dashboard');
// })->middleware(['auth', 'verified'])->name('dashboard');

// Route::middleware('auth')->group(function () {
//     Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
//     Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
//     Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
// });

require __DIR__.'/auth.php';

