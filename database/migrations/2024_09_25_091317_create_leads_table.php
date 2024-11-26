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

        Schema::create('leads', function (Blueprint $table) {
            $table->id();
            $table->string('reference');
            $table->string('agent');
            $table->string('heure');
            $table->date('date');
            $table->foreignId('thematique_id')->constrained('thematiques')->onDelete('cascade');
            $table->foreignId('ville_id')->constrained('villes')->onDelete('cascade');
            $table->foreignId('departement_id')->constrained('departements')->onDelete('cascade');
            $table->foreignId('code_postale_id')->constrained('code_postales')->onDelete('cascade');
            $table->string('code_postale');
            $table->string('modeConsommation');
            $table->string('proprietaire');
            $table->decimal('metrage', 8, 2);
            $table->text('adressePostale');
            $table->string('disponibilite');
            $table->text('commentaireAgent');
            $table->text('commentaireAuditeur');
            $table->string('lienMp3Bip')->nullable();
            $table->string('lienMp3')->nullable();
            $table->boolean('publier')->default(0);
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('prospect_id')->constrained('prospects')->onDelete('cascade');
            $table->text('adresse_cache');
            $table->text('adresse_reelle');
            $table->boolean('payer')->default(0);
            $table->decimal("prix", 10, 2);
            $table->string('description')->nullable();
            $table->softDeletes();
            $table->timestamps();
        });
        
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('leads');
    }
};
