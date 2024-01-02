<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Models\BldcDevice;
use App\Models\NddcDevice;
use Carbon\Carbon;

class DeviceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function index()
    // {
    //     $data['device_list'] = Device::all();
    //     return view('admin.devices.index',$data);
    // }
    public function bldcDevices()
    {
        $data['device_list'] =BldcDevice::orderBy('hostname', 'asc')->get();
        return view('admin.devices.bldc_devices',$data);
    }
    public function nddcDevices()
    {
        $data['device_list'] = NddcDevice::orderBy('hostname', 'asc')->get();
        return view('admin.devices.nddc_devices', $data);
    }

    // public function getBldcDeviceStatusAndSave()
    // {
    //     $observiumUrl = 'http://192.168.5.92/api/v0/devices'; // Replace with your Observium server URL
    //     $username = 'support';
    //     $password = '@dmin#321';

    //     $client = new Client([
    //         'auth' => [$username, $password],
    //     ]);

    //     try {
    //         $response = $client->request('GET', $observiumUrl);
    //         $devices = json_decode($response->getBody(), true);

    //         // Ensure 'devices' array exists in the response and iterate through
    //         if (isset($devices['devices']) && is_array($devices['devices'])) {
    //             foreach ($devices['devices'] as $device) {
    //                 // Find the device by device_id in the database
    //                 $existingDevice = BldcDevice::where('device_id', $device['device_id'])->first();

    //                 if ($existingDevice) {
    //                     // Update existing device data
    //                     $existingDevice->update([
    //                         'status' => $device['status'],
    //                         'hostname' => $device['hostname'],
    //                         'os' => $device['features'],
    //                         'last_rebooted' => $device['last_rebooted'],
    //                         'uptime' => $device['uptime'],
    //                         'location' => $device['location'],
    //                         'type' => $device['type'],
    //                     ]);
    //                 } else {
    //                     // Create a new Device model instance and fill it with data
    //                     $newDevice = new BldcDevice([
    //                         'device_id' => $device['device_id'],
    //                         'status' => $device['status'],
    //                         'hostname' => $device['hostname'],
    //                         'os' => $device['features'],
    //                         'last_rebooted' => $device['last_rebooted'],
    //                         'uptime' => $device['uptime'],
    //                         'location' => $device['location'],
    //                         'type' => $device['type'],
    //                     ]);

    //                     // Save the device data into the 'devices' table
    //                     $newDevice->save();
    //                 }
    //             }
    //         }

    //         return response()->json(['message' => 'Device data updated/created successfully']);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    // }


// public function getBldcDeviceStatusAndSave()
// {
//     $observiumUrl = 'http://192.168.5.92/api/v0/devices'; // Replace with your Observium server URL
//     $username = 'support';
//     $password = '@dmin#321';

//     $client = new Client([
//         'auth' => [$username, $password],
//     ]);

//     try {
//         $response = $client->request('GET', $observiumUrl);
//         $devices = json_decode($response->getBody(), true);

//         if (isset($devices['devices']) && is_array($devices['devices'])) {
//             foreach ($devices['devices'] as $device) {
//                 $existingDevice = BldcDevice::where('device_id', $device['device_id'])->first();

//                 if ($existingDevice) {
//                     $existingDevice->update([
//                         'status' => $device['status'],
//                         'hostname' => $device['hostname'],
//                         'os' => $device['os'],
//                         'last_rebooted' => $device['last_rebooted'],
//                         'location' => $device['location'],
//                         'type' => $device['type'],
//                         'uptime' => Carbon::createFromTimestamp($device['uptime'])->setTimezone('Asia/Dhaka')->toDateTimeString(),
//                     ]);
//                 } else {
//                     $newDevice = new BldcDevice([
//                         'device_id' => $device['device_id'],
//                         'status' => $device['status'],
//                         'hostname' => $device['hostname'],
//                         'os' => $device['os'],
//                         'last_rebooted' => $device['last_rebooted'],
//                         'location' => $device['location'],
//                         'type' => $device['type'],
//                         'uptime' => Carbon::createFromTimestamp($device['uptime'])->setTimezone('Asia/Dhaka')->toDateTimeString(),
//                     ]);

//                     $newDevice->save();
//                 }
//             }
//         }

//         return response()->json(['message' => 'Device data updated/created successfully']);
//     } catch (\Exception $e) {
//         return response()->json(['error' => $e->getMessage()], 500);
//     }
// }

// public function getBldcDeviceStatusAndSave()
// {
//     $observiumUrl = 'http://192.168.5.92/api/v0/devices'; // Replace with your Observium server URL
//     $username = 'support';
//     $password = '@dmin#321';

//     $client = new Client([
//         'auth' => [$username, $password],
//     ]);

//     try {
//         $response = $client->request('GET', $observiumUrl);
//         $devices = json_decode($response->getBody(), true);

//         if (isset($devices['devices']) && is_array($devices['devices'])) {
//             foreach ($devices['devices'] as $device) {
//                 // Get CPU utilization information for each device
//                 $deviceUrl = 'http://192.168.5.92/api/v0/devices/' . $device['device_id'];
//                 $deviceResponse = $client->request('GET', $deviceUrl);
//                 $deviceInfo = json_decode($deviceResponse->getBody(), true);

//                 $ssCpuRawSystemPerc = isset($deviceInfo['ssCpuRawSystem']['perc']) ? number_format($deviceInfo['ssCpuRawSystem']['perc'], 3) . '%' : null;

//                 $existingDevice = BldcDevice::where('device_id', $device['device_id'])->first();

//                 if ($existingDevice) {
//                     $existingDevice->update([
//                         'status' => $device['status'],
//                         'hostname' => $device['hostname'],
//                         'os' => $device['os'],
//                         'last_rebooted' => $device['last_rebooted'],
//                         'location' => $device['location'],
//                         'type' => $device['type'],
//                         'ss_cpu_raw_system_perc' => $ssCpuRawSystemPerc,
//                         'uptime' => Carbon::createFromTimestamp($device['uptime'])->setTimezone('Asia/Dhaka')->toDateTimeString(),
//                     ]);
//                 } else {
//                     $newDevice = new BldcDevice([
//                         'device_id' => $device['device_id'],
//                         'status' => $device['status'],
//                         'hostname' => $device['hostname'],
//                         'os' => $device['os'],
//                         'last_rebooted' => $device['last_rebooted'],
//                         'location' => $device['location'],
//                         'type' => $device['type'],
//                         'ss_cpu_raw_system_perc' => $ssCpuRawSystemPerc,
//                         'uptime' => Carbon::createFromTimestamp($device['uptime'])->setTimezone('Asia/Dhaka')->toDateTimeString(),
//                     ]);

//                     $newDevice->save();
//                 }
//             }
//         }

//         return response()->json(['message' => 'Device data updated/created successfully']);
//     } catch (\Exception $e) {
//         return response()->json(['error' => $e->getMessage()], 500);
//     }
// }

// public function getBldcDeviceStatusAndSave()
// {
//     $observiumUrl = 'http://192.168.5.92/api/v0/devices'; // Replace with your Observium server URL
//     $username = 'support';
//     $password = '@dmin#321';

//     $client = new Client([
//         'auth' => [$username, $password],
//     ]);

//     try {
//         $response = $client->request('GET', $observiumUrl);
//         $devices = json_decode($response->getBody(), true);

//         if (isset($devices['devices']) && is_array($devices['devices'])) {
//             foreach ($devices['devices'] as $device) {
//                 // Get device information from the API
//                 $deviceUrl = 'http://192.168.5.92/api/v0/devices/' . $device['device_id'];
//                 $deviceResponse = $client->request('GET', $deviceUrl);
//                 $deviceInfo = json_decode($deviceResponse->getBody(), true);

//                 // Extract ssCpuRawSystem data from the device information
//                 if (isset($deviceInfo['device']['state']['ucd_ss_cpu']['ssCpuRawSystem']['perc'])) {
//                     $ssCpuRawSystemPerc = number_format($deviceInfo['device']['state']['ucd_ss_cpu']['ssCpuRawSystem']['perc'], 3) . '%';
//                 } else {
//                     $ssCpuRawSystemPerc = null; // Handle the case when the data is not available
//                 }

//                 // Update or create records based on the retrieved data
//                 $existingDevice = BldcDevice::where('device_id', $device['device_id'])->first();

//                 if ($existingDevice) {
//                     $existingDevice->update([
//                         'status' => $device['status'],
//                         'hostname' => $device['hostname'],
//                         'os' => $device['os'],
//                         'last_rebooted' => $device['last_rebooted'],
//                         'location' => $device['location'],
//                         'type' => $device['type'],
//                         'ss_cpu_raw_system_perc' => $ssCpuRawSystemPerc,
//                         'uptime' => Carbon::createFromTimestamp($device['uptime'])->setTimezone('Asia/Dhaka')->toDateTimeString(),
//                         // Add other fields you want to update here
//                     ]);
//                 } else {
//                     $newDevice = new BldcDevice([
//                         'device_id' => $device['device_id'],
//                         'status' => $device['status'],
//                         'hostname' => $device['hostname'],
//                         'os' => $device['os'],
//                         'last_rebooted' => $device['last_rebooted'],
//                         'location' => $device['location'],
//                         'type' => $device['type'],
//                         'ss_cpu_raw_system_perc' => $ssCpuRawSystemPerc,
//                         'uptime' => Carbon::createFromTimestamp($device['uptime'])->setTimezone('Asia/Dhaka')->toDateTimeString(),
//                         // Add other fields you want to create here
//                     ]);

//                     $newDevice->save();
//                 }
//             }
//         }

//         return response()->json(['message' => 'Device data updated/created successfully']);
//     } catch (\Exception $e) {
//         return response()->json(['error' => $e->getMessage()], 500);
//     }
// }
    public function getBldcDeviceStatusAndSave()
    {
        $observiumUrl = 'http://192.168.5.92/api/v0/devices'; // Replace with your Observium server URL
        $username = 'support';
        $password = '@dmin#321';

        $client = new Client([
            'auth' => [$username, $password],
        ]);

        try {
            $response = $client->request('GET', $observiumUrl);
            $devices = json_decode($response->getBody(), true);

            if (isset($devices['devices']) && is_array($devices['devices'])) {
                foreach ($devices['devices'] as $device) {
                    // Get CPU utilization information for each device
                    $deviceUrl = 'http://192.168.5.92/api/v0/devices/' . $device['device_id'];
                    $deviceResponse = $client->request('GET', $deviceUrl);
                    $deviceInfo = json_decode($deviceResponse->getBody(), true);

                    // Extract ssCpuRawSystem data
                    $ssCpuRawSystemPerc = null;
                    if (isset($deviceInfo['device']['state']['ucd_ss_cpu']['ssCpuRawSystem']['perc'])) {
                        // Extracting the raw value without the percentage sign
                        $ssCpuRawSystemPerc = round($deviceInfo['device']['state']['ucd_ss_cpu']['ssCpuRawSystem']['perc']);
                    }

                    // dd($ssCpuRawSystemPerc);

                    // Check if the device exists in the database
                    $existingDevice = BldcDevice::where('device_id', $device['device_id'])->first();

                    if ($existingDevice) {
                        $existingDevice->update([
                            // Update existing device details
                            'status' => $device['status'],
                            'hostname' => $device['hostname'],
                            'os' => $device['os'],
                            'last_rebooted' => $device['last_rebooted'],
                            'location' => $device['location'],
                            'type' => $device['type'],
                            'ss_cpu_raw_system_perc' => $ssCpuRawSystemPerc, // Update ss_cpu_raw_system_perc
                            'uptime' => Carbon::createFromTimestamp($device['uptime'])->setTimezone('Asia/Dhaka')->toDateTimeString(),
                        ]);
                    } else {
                        // Create a new device record
                        $newDevice = new BldcDevice([
                            'device_id' => $device['device_id'],
                            'status' => $device['status'],
                            'hostname' => $device['hostname'],
                            'os' => $device['os'],
                            'last_rebooted' => $device['last_rebooted'],
                            'location' => $device['location'],
                            'type' => $device['type'],
                            'ss_cpu_raw_system_perc' => $ssCpuRawSystemPerc, // Set ss_cpu_raw_system_perc for new device
                            'uptime' => Carbon::createFromTimestamp($device['uptime'])->setTimezone('Asia/Dhaka')->toDateTimeString(),
                        ]);

                        $newDevice->save();
                    }
                }
            }

            return response()->json(['message' => 'Device data updated/created successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }




    public function getNddcDeviceStatusAndSave()
    {
        $observiumUrl = 'http://192.168.5.230/api/v0/devices'; // Replace with your Observium server URL
        $username = 'support';
        $password = '@dmin#321';

        $client = new Client([
            'auth' => [$username, $password],
        ]);

        try {
            $response = $client->request('GET', $observiumUrl);
            $devices = json_decode($response->getBody(), true);

            // Ensure 'devices' array exists in the response and iterate through
            if (isset($devices['devices']) && is_array($devices['devices'])) {
                foreach ($devices['devices'] as $device) {
                    // Create a new Device model instance and fill it with data
                    $newDevice = new NddcDevice([
                        'device_id' => $device['device_id'],
                        'status' => $device['status'],
                        'hostname' => $device['hostname'],
                        'os' => $device['os'],
                        'last_rebooted' => $device['last_rebooted'],
                        'location' => $device['location'],
                        'type' => $device['type'],
                    ]);

                    // Save the device data into the 'devices' table
                    $newDevice->save();
                }
            }

            return response()->json(['message' => 'Device data saved successfully']);
        } catch (\Exception $e) {
            return response()->json(['error' => $e->getMessage()], 500);
        }
    }

   


}