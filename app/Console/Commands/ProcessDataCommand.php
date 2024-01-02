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
        DeviceController::getBldcDeviceStatusAndSave();
        // DeviceController::getNddcDeviceStatusAndSave(); 
        $this->info('Data processed successfully.');
    }
}
