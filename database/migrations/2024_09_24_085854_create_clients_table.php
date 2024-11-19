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
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('nom');
            $table->string('prenom');
            $table->string('tel');
            $table->string('email');
            $table->string('entreprise');
            $table->string('mot_de_passe');
            $table->boolean('accepter')->default(0);
            $table->boolean('activer')->default(0);
            $table->text('addresse');
            $table->string('numero_identification');
            $table->string('siren');
            $table->string('siret');
            $table->string('rcs');
            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
