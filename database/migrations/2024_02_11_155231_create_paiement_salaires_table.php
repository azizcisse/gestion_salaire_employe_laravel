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
        Schema::create('paiement_salaires', function (Blueprint $table) {
            $table->id();
            $table->string('references');
            $table->unsignedBigInteger('employe_id');
            $table->foreign('employe_id')->references('id')->on('employes');
            $table->string('montant');
            $table->dateTime('date_debut_paiement');
            $table->dateTime('date_validation');
            $table->enum('status', ['REUSSI','ECHOUE'])->default('REUSSI');
            $table->enum('mois_paiement', ['JANVIER','FEVRIER','MARS','AVRIL','MAI','JUIN',
            'JUILLET','AOUT','SEPTEMBRE','OCTOBRE','NOVEMBRE','DECEMBRE']);
            $table->string('annee_paiement');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('paiement_salaires');
    }
};
