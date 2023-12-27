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
        Schema::create('application_status', function (Blueprint $table) {
            $table->id();
            $table->foreignId('app_detail_id')->constrained('application_details');
            $table->date('reported_date')->nullable();
            $table->time('reported_time')->nullable();
            $table->string('type')->nullable();
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('application_status');
    }
};
