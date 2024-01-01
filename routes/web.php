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
use App\Http\Controllers\ApplicationStatusController;
use App\Http\Controllers\TestController;
use App\Http\Controllers\DeviceController;
use App\Models\Cprofile;
use App\Models\NotifiedChannel;
use App\Models\BldcDevice;
use App\Models\NddcDevice;





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

    $data['totalDevices'] = BldcDevice::count();
    $data['device_up'] = BldcDevice::where('status', 1)->count();
    $data['device_down'] = BldcDevice::where('status', 0)->count();

    $data['totalNddcDevices'] = NddcDevice::count();
    $data['nddc_device_up'] = NddcDevice::where('status', 1)->count();
    $data['nddc_device_down'] = NddcDevice::where('status', 0)->count();

    return view('admin.dashboard.index' ,$data);
})->middleware(['auth', 'verified'])->name('dashboard');



//TestController
// Route::get('/test',[TestController::class,'test']);
// Route::get('/ping',[TestController::class,'index']);
// Route::get('/ob',[TestController::class,'ob']);

// Route::get('/post',[ApplicationStatusController::class,'test']);
// Route::get('/ping',[ApplicationStatusController::class,'ping']);

// upload data using route
// Route::get('/get_nddc_devices',[DeviceController::class,'getNddcDeviceStatusAndSave']);
// Route::get('/get_bldc_devices',[DeviceController::class,'getBldcDeviceStatusAndSave']);


Route::get('/bldc_devices',[DeviceController::class,'bldcDevices']);
Route::get('/nddc_devices',[DeviceController::class,'nddcDevices']);




Route::middleware('auth')->group(function () {

//dashboard

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

//channe
Route::get('/channel_playing', [ChannelPlayingController::class, 'index']);

//server health checking

// Application name
Route::get('/app_name', [ApplicationNameController::class, 'index']);
Route::get('/app_name/create', [ApplicationNameController::class, 'create']);
Route::post('/app_name', [ApplicationNameController::class, 'store']);
Route::get('/app_name/{id}/edit', [ApplicationNameController::class, 'edit']);
Route::put('/app_name/{id}', [ApplicationNameController::class, 'update']);
Route::delete('/app_name/{id}', [ApplicationNameController::class, 'destroy']);

// Application Details
Route::get('/app_details', [AppDetailsController::class, 'index']);
Route::get('/app_details/create', [AppDetailsController::class, 'create']);
Route::post('/app_details', [AppDetailsController::class, 'store']);
Route::get('/app_details/{id}/edit', [AppDetailsController::class, 'edit']);
Route::put('/app_details/{id}', [AppDetailsController::class, 'update']);
Route::delete('/app_details/{id}', [AppDetailsController::class, 'destroy']);

//Application Status
Route::get('/application_status', [ApplicationStatusController::class, 'index']);
// Route::get('/test', [ApplicationStatusController::class, 'index']);

  
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



// Route::get('/test',[TestController::class,'index']);

require __DIR__.'/auth.php';

