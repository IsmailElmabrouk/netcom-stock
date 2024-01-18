<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('facturedevent', function (Blueprint $table) {
            $table->id();
        $table->unsignedBigInteger('product_id');
        $table->unsignedBigInteger('client_id');
        $table->unsignedBigInteger('magasiner_id'); // Ajout de la colonne pour la relation

        $table->date('date');
        $table->integer('quantity');
        $table->decimal('total_amount', 10, 2);
         $table->string('payment_method');
        // Add new attributes here
        $table->string('status_payment');
        $table->boolean('remiss_applique');
        $table->timestamps();
        
        $table->foreign('product_id')->references('id')->on('products');
        // Add foreign key constraint for 'magasiner_id'
        $table->foreign('magasiner_id')->references('id')->on('users'); // Référence à la table 'users' pour le magasiner_id
        $table->foreign('client_id')->references('id')->on('clients');

    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('facturedevent');
    }
};
