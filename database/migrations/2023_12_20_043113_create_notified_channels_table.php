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
        Schema::create('notified_channels', function (Blueprint $table) {
            $table->id();
            $table->string('source_provider')->nullable();
            $table->string('service')->nullable();
            $table->string('incident_number')->nullable();
            $table->string('channel')->nullable();
            $table->string('channel_status')->nullable();
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
        Schema::dropIfExists('notified_channels');
    }
};
