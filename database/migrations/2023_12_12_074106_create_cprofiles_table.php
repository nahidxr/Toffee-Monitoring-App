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
        Schema::create('cprofiles', function (Blueprint $table) {
            $table->id();
            $table->string('Profile_name');
            $table->foreignId('channel_name_id')->constrained('cnames');
            $table->string('Profile_link');
            $table->integer('status')->default(0);
            $table->string('image');
            $table->integer('service_name')->default(0);
            $table->string('transcoder_info');
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
        Schema::dropIfExists('cprofiles');
    }
};
