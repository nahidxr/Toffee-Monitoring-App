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
        Schema::table('cprofiles', function (Blueprint $table) {
            $table->text('transcoder_info')->nullable()->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cprofiles', function (Blueprint $table) {
             // Revert back to the original column type (if needed)
             $table->string('transcoder_info')->change();
        });
    }
};
