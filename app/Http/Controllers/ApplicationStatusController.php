<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ApplicationDetails;
use App\Models\ApplicationStatus;
use Illuminate\Support\Facades\Http;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Symfony\Component\Process\Process;



class ApplicationStatusController extends Controller
{
   
    public function index()
    {   
        // Retrieve data from the ApplicationDetails table
        $data['applicationDetails'] = ApplicationDetails::with('applicationNames')->get();

        // Pass data to the application_status.index view
        return view('admin.application_status.index',$data);
    }


    // public function test()
    // {
    //     try {
    //         // Retrieve all IDs and IP addresses from the database
    //         $applicationDetails = ApplicationDetails::select('id', 'ip')->get();
    
    //         foreach ($applicationDetails as $appDetail) {
    //             $id = $appDetail->id;
    //             $ip = $appDetail->ip;
    //             $port = '80'; // Replace with the port you want to check
    
    //             $response = Http::timeout(5)->get("http://$ip:$port");

    //             // dd($response);
    //             $statusCode = $response->status();
    //             $status = ($statusCode >= 200 && $statusCode < 300) ? 1 : 0; // Assign 1 for 'active', 0 for 'inactive'
    
    //             // Check if a status already exists for the app_detail_id
    //             $existingStatus = ApplicationStatus::where('app_detail_id', $id)->first();
    
    //             if ($existingStatus) {
    //                 // Update the existing status
    //                 $existingStatus->status = $status;
    //                 $existingStatus->reported_date = now()->toDateString();
    //                 $existingStatus->reported_time = now()->toTimeString();
    //                 $existingStatus->type = 'check'; // Adjust the type if needed
    //                 $existingStatus->save();
    //             } else {
    //                 // Create a new status record
    //                 ApplicationStatus::create([
    //                     'app_detail_id' => $id,
    //                     'status' => $status,
    //                     'reported_date' => now()->toDateString(),
    //                     'reported_time' => now()->toTimeString(),
    //                     'type' => 'check', // Adjust the type if needed
    //                 ]);
    //             }
    //         }
    
    //         return response()->json(['status' => 'success']);
    //     } catch (\Exception $e) {
    //         return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    //     }
    // }
    public function ping()
{
    try {
        // Retrieve all IDs and IP addresses from the database
        $applicationDetails = ApplicationDetails::select('id', 'ip')->get();

        foreach ($applicationDetails as $appDetail) {
            $id = $appDetail->id;
            $ip = $appDetail->ip;
                // dd($ip);
            // Perform ping command on the IP address
            $process = new Process(['ping', '-c', '4', $ip]); // Ping with 4 packets
            $process->run();

            // dd($process);

            // Check if the ping was successful
            if ($process->isSuccessful()) {
                // Ping successful, IP is reachable
                $status = 1; // Assign 1 for 'active'
            } else {
                // Ping unsuccessful, IP is unreachable
                $status = 0; // Assign 0 for 'inactive'
            }

            // Check if a status already exists for the app_detail_id
            $existingStatus = ApplicationStatus::where('app_detail_id', $id)->first();

            if ($existingStatus) {
                // Update the existing status
                $existingStatus->status = $status;
                $existingStatus->reported_date = now()->toDateString();
                $existingStatus->reported_time = now()->toTimeString();
                $existingStatus->type = 'check'; // Adjust the type if needed
                $existingStatus->save();
            } else {
                // Create a new status record
                ApplicationStatus::create([
                    'app_detail_id' => $id,
                    'status' => $status,
                    'reported_date' => now()->toDateString(),
                    'reported_time' => now()->toTimeString(),
                    'type' => 'check', // Adjust the type if needed
                ]);
            }
        }

        return response()->json(['status' => 'success']);
    } catch (\Exception $e) {
        return response()->json(['status' => 'error', 'message' => $e->getMessage()]);
    }
}

    



}
