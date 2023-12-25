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
        
        $ip = '150.242.104.102'; // IP address to ping
        
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
        $ip = '150.242.104.102'; // Replace with your IP address
        $port = '80'; // Replace with the port you want to check

        try {
            $response = Http::timeout(1)->get("http://$ip:$port");

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
}
