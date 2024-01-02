<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DeviceController;

class ProcessDataCommand extends Command
{
    protected $signature = 'process:data';
    protected $description = 'Process data for dashboard';

    public function __construct()
    {
        parent::__construct();
    }

    public function handle()
    {
        // Instantiate the DeviceController and call the method
        $deviceController = new DeviceController();
        $deviceController->getBldcDeviceStatusAndSave();
        // $deviceController->getNddcDeviceStatusAndSave();

        $this->info('Device status updated successfully.');
    }
}
