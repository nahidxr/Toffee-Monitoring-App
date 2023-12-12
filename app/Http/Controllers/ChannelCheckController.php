<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Cprofile;
use Illuminate\Support\Facades\Http;


class ChannelCheckController extends Controller
{
   
    public function index()
    {
        $data['cprofile_list'] = Cprofile::get();
        // dd($data);
        return view('admin.channel_checking.index',$data);
    }

    public function sendSlackNotification(Request $request)
    {
        $channelData = $request->input('channelData');

        // Construct the message to be sent to Slack
        $message = "Channel validation failed for: $channelData";

        // Send the notification to Slack using the webhook URL
        $webhookUrl = 'https://hooks.slack.com/services/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';

        $response = Http::post($webhookUrl, [
            'text' => $message,
        ]);

        // Check if the notification was sent successfully
        if ($response->successful()) {
            return response()->json(['message' => 'Slack notification sent']);
        } else {
            return response()->json(['error' => 'Failed to send Slack notification'], 500);
        }
    }
    

    public function store(Request $request)
    {
        //
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        //
    }

    public function update(Request $request, $id)
    {
        //
    }

    public function destroy($id)
    {
        //
    }
}
