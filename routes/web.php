<?php

use App\Http\Controllers\ProfileController;

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\CnameController;
use App\Http\Controllers\CprofileController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\ChannelCheckController;
use App\Http\Controllers\SlackNotificationController;
use App\Http\Controllers\ChannelPlayingController;
use App\Http\Controllers\ApplicationNameController;
use App\Http\Controllers\AppDetailsController;
use App\Http\Controllers\TestController;
use App\Models\Cprofile;
use App\Models\NotifiedChannel;




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

Route::get('/dashboard', function () {
    $data['total_profiles'] = Cprofile::count();
    $data['inactive_channels'] = Cprofile::where('status', 0)->count();
    $data['inactiveChannelsCount'] = NotifiedChannel::where('channel_status', 'Invalid')
    ->whereIn('channel_name_id', function ($query) {
        $query->select('channel_name_id')
            ->from('notified_channels')
            ->where('channel_status', 'Invalid')
            ->groupBy('channel_name_id');
      })
    ->whereIn('channel_name_id', function ($query) {
    $query->select('channel_name_id')
    ->from('cprofiles')
    ->where('status', 1)
    ->groupBy('channel_name_id');
    })
    ->selectRaw('count(*) as count, channel_name_id')
    ->groupBy('channel_name_id')
    ->get()
    ->count();

    return view('admin.dashboard.index' ,$data);
})->middleware(['auth', 'verified'])->name('dashboard');



//TestController
Route::get('/test',[TestController::class,'index']);
// Route::get('/post',[TestController::class,'test']);



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

//server health checking

// Route::resource('Settings/appdetails', App\Http\Controllers\AppdetailController::class);
// Route::resource('Settings/ApplicationName', App\Http\Controllers\ApplicationNameController::class);


// Route::resource('application-names', ApplicationNameController::class);
// channel name
Route::get('/app_name', [ApplicationNameController::class, 'index']);
Route::get('/app_name/create', [ApplicationNameController::class, 'create']);
Route::post('/app_name', [ApplicationNameController::class, 'store']);
Route::get('/app_name/{id}/edit', [ApplicationNameController::class, 'edit']);
Route::put('/app_name/{id}', [ApplicationNameController::class, 'update']);
Route::delete('/app_name/{id}', [ApplicationNameController::class, 'destroy']);

// channel profile
Route::get('/app_details', [AppDetailsController::class, 'index']);
Route::get('/app_details/create', [AppDetailsController::class, 'create']);
Route::post('/app_details', [AppDetailsController::class, 'store']);
Route::get('/app_details/{id}/edit', [AppDetailsController::class, 'edit']);
Route::put('/app_details/{id}', [AppDetailsController::class, 'update']);
Route::delete('/app_details/{id}', [AppDetailsController::class, 'destroy']);

  
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



Route::get('/test',[TestController::class,'index']);

require __DIR__.'/auth.php';

