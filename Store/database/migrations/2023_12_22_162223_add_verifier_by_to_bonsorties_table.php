<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   // Dans la migration pour la table BonSorties
public function up()
{
    Schema::table('bonsorties', function (Blueprint $table) {
        $table->boolean('verified_by_commercial')->default(false);
    });
}

public function down()
{
    Schema::table('bonsorties', function (Blueprint $table) {
        $table->dropColumn('verified_by_commercial');
    });
}

};
