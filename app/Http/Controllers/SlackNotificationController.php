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
        $serviceName = $request->input('serviceName');
        $status = $request->input('status');
        $channelId = $request->input('channelId');
        $channelProfileId = $request->input('channelProfileId');

        // Check if the channel exists in notified_channels table and its status
        $existingChannel = NotifiedChannel::where('channel', $channelData)->first();

        if ($existingChannel) {
            if ($existingChannel->channel_status === 'Valid') {
                // If the channel exists and is marked as valid, update it to be invalid
                $existingChannel->update(['channel_status' => 'Invalid']);

                // Update the channel_name_id if it's different from the current one
                if ($existingChannel->channel_name_id !== $channelId) {
                    $existingChannel->update(['channel_name_id' => $channelId]);
                }
                 // Update the channel_name_id if it's different from the current one
                 if ($existingChannel->cprofile_id !== $channelProfileId) {
                    $existingChannel->update(['cprofile_id' => $channelProfileId]);
                }
                if ($existingChannel->cprofile_id === NULL) {
                    $existingChannel->cprofile_id = $channelProfileId;
                    $existingChannel->save();
                }

                // Send the notification to Slack using the webhook URL
                $webhookUrl = 'https://hooks.slack.com/services/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';

                $response = Http::post($webhookUrl, [
                    // 'text' => ">Channel Profile failed for: $channelData on Service: $serviceName",
                    'attachments' => [
                        [
                            'color' => 'danger', // Red color
                            'text' => "Channel Profile failed for: $channelData on Service: $serviceName",
                        ],
                    ],
                ]);

                if ($response->successful()) {
                    return response()->json(['message' => 'Slack notification sent']);
                } else {
                    return response()->json(['error' => 'Failed to send Slack notification'], 500);
                }
            } else {
                // If the channel exists and is already marked as invalid, skip creating a new entry or sending Slack notification
                return response()->json(['message' => 'Channel already marked as Invalid']);
            }
        } else {
            // If the channel doesn't exist, create a new entry
            NotifiedChannel::create([
                'source_provider' => 'null', // Replace with appropriate data
                'service' => $serviceName, // Replace with appropriate data
                'incident_number' => 'null', // Replace with appropriate data
                'channel' => $channelData,
                'channel_status' => $status, // Store status received from the request
                'channel_channel_name_id' => $channelId, // Store channelId received from the request

            ]);

            // Send the notification to Slack using the webhook URl
            $webhookUrl = 'https://hooks.slack.com/services/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';

            $response = Http::post($webhookUrl, [
                // 'text' => ">Channel Profile failed for: $channelData on Service: $serviceName",
                'attachments' => [
                    [
                        'color' => 'danger', // Red color
                        'text' => "Channel Profile failed for: $channelData on Service: $serviceName",
                    ],
                ],
            ]);

            if ($response->successful()) {
                return response()->json(['message' => 'Slack notification sent']);
            } else {
                return response()->json(['error' => 'Failed to send Slack notification'], 500);
            }
        }
    }

   public function sendValidSlackNotification(Request $request)
    {
    $channelData = $request->input('channelData');
    $serviceName = $request->input('serviceName');
    $status = $request->input('status');
    $channelId = $request->input('channelId');
    $channelProfileId = $request->input('channelProfileId');


    // Check if the channel exists in notified_channels table and its status
    $existingChannel = NotifiedChannel::where('channel', $channelData)->first();

    if ($existingChannel) {
        if ($existingChannel->channel_status === 'Invalid') {
            // If the channel exists and is marked as invalid, update it to be valid
            $existingChannel->update(['channel_status' => 'Valid']);
            // Update the channel_name_id if it's different from the current one
            if ($existingChannel->channel_name_id !== $channelId) {
                $existingChannel->update(['channel_name_id' => $channelId]);
            }
             // Update the channel_name_id if it's different from the current one
             if ($existingChannel->cprofile_id !== $channelProfileId) {
                $existingChannel->update(['cprofile_id' => $channelProfileId]);
            }
            if ($existingChannel->cprofile_id === NULL) {
                $existingChannel->cprofile_id = $channelProfileId;
                $existingChannel->save();
            }

            // Send the notification to Slack using the webhook URL
            $webhookUrl = 'https://hooks.slack.com/services/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';

            $response = Http::post($webhookUrl, [
                // 'text' => ">Channel Profile Successful for: $channelData on Service: $serviceName :green_circle:",
                // 'text' => ">Channel Profile Successful for: $channelData on Service: $serviceName",
                'attachments' => [
                    [
                        'color' => 'good', // Red color
                        'text' => "Channel Profile Successful for: $channelData on Service: $serviceName",
                    ],
                ],
               
            ]);

            if ($response->successful()) {
                return response()->json(['message' => 'Slack notification sent']);
            } else {
                return response()->json(['error' => 'Failed to send Slack notification'], 500);
            }
        } else {
            // If the channel exists and is already marked as valid, skip creating a new entry or sending Slack notification
            return response()->json(['message' => 'Channel already marked as Valid']);
        }
    } else {
        // If the channel doesn't exist, create a new entry (Uncomment this block if necessary)

        NotifiedChannel::create([
            'source_provider' => 'null', // Replace with appropriate data
            'service' => $serviceName, // Replace with appropriate data
            'incident_number' => 'null', // Replace with appropriate data
            'channel' => $channelData,
            'channel_status' => $status, // Store status received from the request
            'channel_name_id' => $channelId, // Store channelId received from the request
            'cprofile_id' => $channelProfileId, // Store channelId received from the request

        ]);

        // Send the notification to Slack using the webhook URL (Uncomment this block if necessary)
        $webhookUrl = 'https://hooks.slack.com/services/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';

        $response = Http::post($webhookUrl, [
            'text' => "Channel Profile Successful for: $channelData on Service: $serviceName",
        ]);

        if ($response->successful()) {
            return response()->json(['message' => 'Slack notification sent']);
        } else {
            return response()->json(['error' => 'Failed to send Slack notification'], 500);
        }
    }



}

    // public function sendChannelCounts(Request $request)
    // {
    //     $totalChannels = $request->input('totalChannels');
    //     $validChannels = $request->input('validChannels');
    //     $invalidChannels = $request->input('invalidChannels');

    //     // Construct the message to be sent to Slack
    //     $message = "Total Channels: $totalChannels\nValid Channels: $validChannels\nInvalid Channels: $invalidChannels";

    //     // Send the counts notification to Slack using the webhook URL
    //     //  $webhookUrl = 'https://hooks.slack.com/services/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';

    //     $response = Http::post($webhookUrl, [
    //         'text' => $message,
    //     ]);

    //     // Check if the notification was sent successfully
    //     if ($response->successful()) {
    //         return response()->json(['message' => 'Channel counts sent to Slack']);
    //     } else {
    //         return response()->json(['error' => 'Failed to send channel counts to Slack'], 500);
    //     }
    // }
}
