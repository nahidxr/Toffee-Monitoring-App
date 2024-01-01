<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Http\Controllers\DeviceController;

class ProcessDataCommand extends Command
{
    protected $signature = 'process:data';
    protected $description = 'Process data for dashboard';

    public function handle()
    {
        DeviceController::getBlddcDeviceStatusAndSave();
        DeviceController::getNddcDeviceStatusAndSave(); 
        $this->info('Data processed successfully.');
    }
}
