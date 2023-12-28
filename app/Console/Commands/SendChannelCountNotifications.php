<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\SlackNotificationController;


class SendChannelCountNotifications extends Command
{
    protected $signature = 'send:channel-status-notifications';

    protected $description = 'Send notifications for channel statuses';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        $slackController = new SlackNotificationController();
        $slackController->sendChannelCounts();
        $this->info('Channel status notifications sent successfully.');
    }
}
