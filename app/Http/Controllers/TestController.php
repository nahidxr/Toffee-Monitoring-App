<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;


class TestController extends Controller
{
   public function index()
    {
        
        $ip = '192.168.5.102'; // IP address to ping
        
        $process = new Process(['ping', '-c', '4', $ip]); // Perform a ping with 4 packets
        $process->run();

        if ($process->isSuccessful()) {
            return response()->json(['status' => 'active']);
        } else {
            return response()->json(['status' => 'inactive']);
        }


    }
 
    
    public function test()
    {
        $ip = '192.168.5.102'; // Replace with your IP address
        $port = '80'; // Replace with the port you want to check

        try {
            $response = Http::timeout(5)->get("http://$ip:$port");

            // dd($response);

            $statusCode = $response->status();

            if ($statusCode >= 200 && $statusCode < 300) {
                return response()->json(['status' => 'active']);
            } else {
                return response()->json(['status' => 'inactive']);
            }
        } catch (\Exception $e) {
            return response()->json(['status' => 'inactive']);
        }
    }


    public function ob(){

          //ports info

    // $observiumUrl = 'http://192.168.5.92/api/v0/ports'; // Replace with your Observium server URL
    // $username = 'support';
    // $password = '@dmin#321';

    // $client = new Client([
    //     'auth' => [$username, $password],
    // ]);

    // try {
    //     $response = $client->request('GET', $observiumUrl);
    //     $portsData = json_decode($response->getBody(), true);

    //     if (isset($portsData['ports'])) {
    //         $firstTwentyPorts = array_slice($portsData['ports'], 0, 20);
    //         dd( $firstTwentyPorts);
    //         return response()->json(['first_twenty_ports' => $firstTwentyPorts]);
    //     } else {
    //         return response()->json(['error' => 'Ports data not found in response'], 500);
    //     }
    // } catch (\Exception $e) {
    //     return response()->json(['error' => $e->getMessage()], 500);
    // }




    

        // $observiumUrl = 'http://192.168.5.236/api/v0/devices';
        // $username = 'support';
        // $password = '$support#342';

        // $client = new Client([
        //     'auth' => [$username, $password],
        //     // 'allow_redirects' => false

           
        // ]);

        // try {
        //     $response = $client->request('GET', $observiumUrl);
        //     $devices = json_decode($response->getBody(), true);
        //     dd($devices);

        //     // Process $devices as needed
        //     return response()->json($devices);
            
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }

        // $observiumUrl = 'http://192.168.5.92/api/v0/devices'; // Replace with your Observium server URL
        // $username = 'support';
        // $password = '@dmin#321';
        
        // $observiumUrl = 'http://192.168.5.236/api/v0/devices'; // Replace with your Observium server URL
        // $username = 'support';
        // $password = '$support#342';

        // $client = new Client([
        //     'auth' => [$username, $password],
        // ]);

        // try {
        //     $response = $client->request('GET', $observiumUrl);
        //     $devices = json_decode($response->getBody(), true);

        //     $statuses = [];

        //     // Ensure 'devices' array exists in the response and iterate through
        //     if (isset($devices['devices']) && is_array($devices['devices'])) {
        //         foreach ($devices['devices'] as $device) {
        //             $statuses[] = [
        //                 'device_id' => $device['device_id'],
        //                 'status' => $device['status'],
        //                 'hostname' => $device['hostname'],
        //                 'os' => $device['os'],
        //                 'last_rebooted' => $device['last_rebooted'],
        //                 'location' => $device['location'],
        //                 'type' => $device['type'],
        //             ];
        //         }
        //     }

        //     // Output extracted data to check
        //     dd($statuses);

        //     // Return the data as JSON response
        //     return response()->json($statuses);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }


        // $observiumUrl = 'http://192.168.5.92/api/v0/devices/?os=ios'; // Replace with your Observium server URL
        // $observiumUrl = 'http://192.168.5.92/api/v0/devices'; // Replace with your Observium server URL
        // $username = 'support';
        // $password = '@dmin#321';

        // $observiumUrl = 'http://192.168.5.236/api/v0/devices'; // Replace with your Observium server URL
        // $username = 'support';
        // $password = '$support#342';

        // $client = new Client([
        //     'auth' => [$username, $password],
        // ]);

        // try {
        //     $response = $client->request('GET', $observiumUrl);
        //     $devices = json_decode($response->getBody(), true);

        //     dd($devices);

        //     // Process $devices as needed
        //     return response()->json($devices);
        // } catch (\Exception $e) {
        //     return response()->json(['error' => $e->getMessage()], 500);
        // }
       
        
    //     $observiumUrl = 'http://192.168.5.236/api/v0/devices'; // Replace with your Observium server URL
    // $username = 'support';
    // $password = '$support#342';

    // $ch = curl_init();

    // curl_setopt($ch, CURLOPT_URL, $observiumUrl);
    // curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
    // curl_setopt($ch, CURLOPT_FOLLOWLOCATION, true); // Allow redirects

    // // Set authentication
    // curl_setopt($ch, CURLOPT_HTTPAUTH, CURLAUTH_BASIC);
    // curl_setopt($ch, CURLOPT_USERPWD, "$username:$password");

    // // Adjust the maximum number of redirects (optional)
    // curl_setopt($ch, CURLOPT_MAXREDIRS, 5); // Set maximum redirects to 5

    // $response = curl_exec($ch);
    // $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    // if ($response === false) {
    //     $error = curl_error($ch); // Get cURL error message
    //     curl_close($ch);
    //     return response()->json(['error' => 'cURL Error: ' . $error], 500);
    // }

    // curl_close($ch);

    // if ($httpCode === 200) {
    //     $devices = json_decode($response, true);
    //     dd($devices); // Dump the retrieved devices
    //     // Process $devices as needed
    //     return response()->json($devices);
    // } elseif ($httpCode === 302) {
    //     $redirectedTo = curl_getinfo($ch, CURLINFO_REDIRECT_URL);
    //     return response()->json(['error' => 'Redirected to: ' . $redirectedTo], $httpCode);
    // } else {
    //     return response()->json(['error' => 'HTTP Request failed with status code: ' . $httpCode], $httpCode);
    // }



    // $observiumUrl = 'http://192.168.5.92/api/v0/devices'; // Replace with your Observium server URL
    // $username = 'support';
    // $password = '@dmin#321';

    // $client = new Client([
    //     'auth' => [$username, $password],
    // ]);

    // try {
    //     $response = $client->request('GET', $observiumUrl);
    //     $devices = json_decode($response->getBody(), true);

    //     $statuses = [];

    //     // Ensure 'devices' array exists in the response and iterate through
    //     if (isset($devices['devices']) && is_array($devices['devices'])) {
    //         foreach ($devices['devices'] as $device) {
    //             $statuses[] = [
    //                 'device_id' => $device['device_id'],
    //                 'status' => $device['status'],
    //             ];
    //         }
    //     }

    //     // Output extracted statuses to check
    //     dd($statuses);

    //     // Return the statuses as JSON response
    //     return response()->json($statuses);
    // } catch (\Exception $e) {
    //     return response()->json(['error' => $e->getMessage()], 500);
    // }



    // $observiumUrl = 'http://192.168.5.92/api/v0/address'; // Replace with your Observium server URL
    //     $username = 'support';
    //     $password = '@dmin#321';

    // $observiumUrl = 'http://192.168.5.236/api/v0/devices'; // Replace with your Observium server URL
    // $username = 'support';
    // $password = '$support#342';

    //     $client = new Client([
    //         'auth' => [$username, $password],
    //     ]);

    //     $queryParams = [
    //         'af' => 'ipv4', // Replace 'ipv4' or 'ipv6' based on the address family you want
    //         // 'device_id' => 1, // Replace with the device ID if you want to filter by device
    //         // 'port_id' => 5, // Replace with the port ID if you want to filter by port
    //     ];

    //     try {
    //         $response = $client->request('GET', $observiumUrl, [
    //             'query' => $queryParams,
    //         ]);

    //         $addresses = json_decode($response->getBody(), true);

    //         // Process $addresses as needed
    //         dd($addresses);
    //         return response()->json($addresses);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }


            // working
    //  $observiumUrl = 'http://192.168.5.92/api/v0/status'; // Replace with your Observium server URL
    //     $username = 'support';
    //     $password = '@dmin#321';

    //     $client = new Client([
    //         'auth' => [$username, $password],
    //     ]);

    //     $queryParams = [
    //         // 'group_id' => 1, // Replace with the desired group ID if needed
    //         'device_id' => 66, // Replace with the desired device ID if needed
    //         // Other optional parameters: 'id', 'class', 'event' (ok, alert, warn, ignore)
    //     ];

    //     try {
    //         $response = $client->request('GET', $observiumUrl, [
    //             'query' => $queryParams,
    //         ]);
    //         $statusInfo = json_decode($response->getBody(), true);
    //         dd($statusInfo);
    //         // Process $statusInfo as needed
    //         return response()->json($statusInfo);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
        
    //ports

    // $observiumUrl = 'http://192.168.5.92/api/v0/ports'; // Replace with your Observium server URL
    //     $username = 'support';
    //     $password = '@dmin#321';

    //     $client = new Client([
    //         'auth' => [$username, $password],
    //     ]);

    //     $queryParams = [
    //         // 'location' => 'some_location', // Replace with desired location if needed
    //         'device_id' => 66, // Replace with desired device ID if needed
    //         // Add more optional parameters as needed based on the API documentation
    //     ];

    //     try {
    //         $response = $client->request('GET', $observiumUrl, [
    //             'query' => $queryParams,
    //         ]);

    //         $portsData = json_decode($response->getBody(), true);

    //         // Process $portsData as needed
    //         dd($portsData);
    //         return response()->json($portsData);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }

  
    // $observiumUrl = 'http://192.168.5.92/api/v0/ports'; // Replace with your Observium server URL
    //     $username = 'support';
    //     $password = '@dmin#321';

    //     $client = new Client([
    //         'auth' => [$username, $password],
    //     ]);

    //     try {
    //         $response = $client->request('GET', $observiumUrl);
    //         $portsData = json_decode($response->getBody(), true);
    //         dd($portsData);
    //         return response()->json(['total_ports' => $totalPorts]);
    //     } catch (\Exception $e) {
    //         return response()->json(['error' => $e->getMessage()], 500);
    //     }
    
    // $observiumUrl = 'http://192.168.5.92/api/v0/ports'; // Replace with your Observium server URL
    // $username = 'support';
    // $password = '@dmin#321';

    // $client = new Client([
    //     'auth' => [$username, $password],
    // ]);

    // $queryParams = [
    //     'limit' => 100, // Limit the number of ports to 100
    //     // Add other optional parameters if needed
    // ];

    // try {
    //     $response = $client->request('GET', $observiumUrl, [
    //         'query' => $queryParams,
    //     ]);

    //     $limitedPorts = json_decode($response->getBody(), true);

    //     // Process $limitedPorts as needed
    //     dd($limitedPorts);
    //     return response()->json($limitedPorts);
    // } catch (\Exception $e) {
    //     return response()->json(['error' => $e->getMessage()], 500);
    // }

    }
}
