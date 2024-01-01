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
            $table->string('device_id');
            $table->string('status');
            $table->string('hostname');
            $table->string('os');
            $table->timestamp('last_rebooted');
            $table->string('location');
            $table->string('type');
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
