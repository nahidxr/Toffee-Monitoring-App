<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\NotifiedChannel;


class SlackNotificationController extends Controller
{
    public function sendInvalidSlackNotification(Request $request)
    {
        $channelData = $request->input('channelData');
        $serviceName = $request->input('serviceName'); // Get the serviceName from the request
        $status = $request->input('status');

        // Construct the message to be sent to Slack including serviceName
        $message = "Channel Profile failed for: $channelData on Service: $serviceName";

        // Send the notification to Slack using the webhook URL
        // $webhookUrl = 'https://hooks.slack.com/services/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';

        $response = Http::post($webhookUrl, [
            'text' => $message,
        ]);

        // Check if the notification was sent successfully
        if ($response->successful()) {

            NotifiedChannel::create([
                'source_provider' => 'null', // Replace with appropriate data
                'service' => $serviceName, // Replace with appropriate data
                'incident_number' => 'null', // Replace with appropriate data
                'channel' => $channelData,
                'channel_status' => $status, // Store status received from the request
                
            ]);

            return response()->json(['message' => 'Slack notification sent']);
        } else {
            return response()->json(['error' => 'Failed to send Slack notification'], 500);
        }
    }

    public function sendValidSlackNotification(Request $request)
    {
        $channelData = $request->input('channelData');
        $serviceName = $request->input('serviceName');
        $status = $request->input('status');
        
    
        // Construct the message to be sent to Slack including serviceName
        $message = "Channel Profile Successful for: $channelData on Service: $serviceName";
    
        // Send the notification to Slack using the webhook URL
        // $webhookUrl = 'https://hooks.slack.com/services/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';
    
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
    public function sendChannelCounts(Request $request)
    {
        $totalChannels = $request->input('totalChannels');
        $validChannels = $request->input('validChannels');
        $invalidChannels = $request->input('invalidChannels');

        // Construct the message to be sent to Slack
        $message = "Total Channels: $totalChannels\nValid Channels: $validChannels\nInvalid Channels: $invalidChannels";

        // Send the counts notification to Slack using the webhook URL
        // $webhookUrl = 'https://hooks.slack.com/services/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'; // Replace with your actual Slack webhook URL

        $response = Http::post($webhookUrl, [
            'text' => $message,
        ]);

        // Check if the notification was sent successfully
        if ($response->successful()) {
            return response()->json(['message' => 'Channel counts sent to Slack']);
        } else {
            return response()->json(['error' => 'Failed to send channel counts to Slack'], 500);
        }
    }
}
