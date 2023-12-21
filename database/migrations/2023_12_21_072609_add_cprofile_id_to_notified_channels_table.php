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
        Schema::table('notified_channels', function (Blueprint $table) {
            $table->unsignedBigInteger('cprofile_id')->nullable();
            $table->foreign('cprofile_id')->references('id')->on('cprofiles');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notified_channels', function (Blueprint $table) {
            $table->dropForeign(['cprofile_id']);
            $table->dropColumn('cprofile_id');
        });
    }
};
