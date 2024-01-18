<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('bonsorties', function (Blueprint $table) {
            $table->boolean('quantities_updated')->default(false);
        });
    }

    public function down()
    {
        Schema::table('bonsorties', function (Blueprint $table) {
            $table->dropColumn('quantities_updated');
        });
    }
};
