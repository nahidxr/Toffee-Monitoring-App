<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Symfony\Component\Process\Process;

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
     


    }
}
