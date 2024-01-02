<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bldc_devices', function (Blueprint $table) {
            $table->id();
            $table->string('device_id')->nullable();
            $table->string('status')->nullable();
            $table->string('hostname')->nullable();
            $table->string('os')->nullable();
            $table->timestamp('last_rebooted')->nullable();
            $table->timestamp('uptime')->nullable();
            $table->string('location')->nullable();
            $table->string('type')->nullable();
            // $table->decimal('ss_cpu_raw_system_perc', 10, 4)->nullable(); // Changed the column type to decimal for percentage
            $table->string('ss_cpu_raw_system_perc')->nullable(); // Changed the column type to decimal for percentage
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('bldc_devices');
    }
};
