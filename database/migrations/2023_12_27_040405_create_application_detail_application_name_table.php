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
        Schema::create('application_detail_application_name', function (Blueprint $table) {
            $table->id();
            $table->foreignId('application_detail_id')->constrained('application_details')
                ->index('ad_application_detail_id_foreign');
            $table->foreignId('application_name_id')->constrained('application_names')
                ->index('ad_application_name_id_foreign');
            // Add any additional fields if needed
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
        Schema::dropIfExists('application_detail_application_name');
    }
};
