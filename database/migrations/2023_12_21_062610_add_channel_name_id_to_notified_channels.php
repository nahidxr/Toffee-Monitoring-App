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
        // Check if the column doesn't exist before adding it
        if (!Schema::hasColumn('notified_channels', 'channel_name_id')) {
            Schema::table('notified_channels', function (Blueprint $table) {
                $table->foreignId('channel_name_id')->nullable()->constrained('cnames');
            });
        }
    }

    public function down()
    {
        Schema::table('notified_channels', function (Blueprint $table) {
            $table->dropColumn('channel_name_id');
        });
    }
};
