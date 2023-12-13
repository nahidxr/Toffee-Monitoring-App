<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Cprofile;

class TestController extends Controller
{
    public function index()
    {

        $cprofile_list = Cprofile::select('image', 'Profile_link')->get();

        $status_codes = [];

        // Iterate through each profile and make HTTP requests for Profile_link
        foreach ($cprofile_list as $profile) {
            $profileLink = $profile->Profile_link;

            // Perform HTTP request to check status for Profile_link
            $response = Http::get($profileLink);
            $statusCode = $response->getStatusCode();

            // Store profile data and status code in the array
            $status_codes[] = [
                'image' => $profile->image,
                'profile_link' => $profileLink,
                'status_code' => $statusCode,
            ];
        }

        // Store the $status_codes array within the $data array with the key 'status_codes'
        $data['status_codes'] = $status_codes;
        // dd($data);

        // Pass the $data array to the view 'admin.test.index'
        return view('admin.test.index', $data);

    }


    
    public function test()
    {
       // $response = Http::get('https://mcdn-test.toffeelive.com/cdn/live/nick/playlist.m3u8');

        // $jsonData = $response->json();

        // $jsonData = $response->json();
        // $result=$response->getStatusCode();
        // $result=$response->body();
        // $result=$response->getReasonPhrase();
        // dd($result);

        // dd($result);
        // $streamUrl = 'https://mcdn-test.toffeelive.com/cdn/live/nick/playlist.m3u8';


        $streamUrl = 'https://mcdn-test.toffeelive.com/cdn/live/nick/playlist.m3u8';
        $response = Http::get($streamUrl);

    // Get the status code from the response
    $statusCode = $response->getStatusCode();

    // Initialize a variable to hold the stream status
    $streamStatus = '';

    // Check if the status code is 200 (OK)
    if ($statusCode === 200) {
        // Get the content of the response
        $content = $response->body();

        // Check if the content indicates a valid HLS playlist (example check)
        if (strpos($content, '#EXTM3U') !== false) {
            // Stream is playable or running
            $streamStatus = 'Stream is playable';
        } else {
            // Stream might have issues (not a valid HLS playlist)
            $streamStatus = 'Stream has issues';
        }
    } else {
        // Handle other status codes as needed
        $streamStatus = 'Stream is not accessible';
    }

    // Return the stream status

    dd($streamStatus);
    // return $streamStatus;




    }
}
