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
        Schema::table('leads', function (Blueprint $table) {
            $table->string('entreprise')->nullable();
            $table->string('gerantNonSalarie')->nullable();
            $table->string('nombreDeSalarie')->nullable();
            $table->string('lange')->nullable();
            $table->string('activite')->nullable();
            $table->string('gerant')->nullable();
            $table->string('modeChauffage')->nullable();
            $table->string('fournisseurGaz')->nullable();
            $table->string('fournisseurElectrecite')->nullable();
            $table->integer('coutGaz')->nullable();
            $table->integer('coutElectrecite')->nullable();
            $table->string('salarie')->nullable();
            $table->integer('datSalarie')->nullable();
            $table->string('thematiqueDinteret')->nullable();
            $table->string('lange2')->nullable();
            $table->string('maison')->nullable();
            $table->string('interetAmeliorationHabitat')->nullable();
            $table->string('fonctionEntreprise')->nullable();
            $table->string('operationActuel')->nullable();
            $table->integer('nombreLineConcernees')->nullable();
            $table->string('telephonFix')->nullable();
            $table->string('telephonMobile')->nullable();
            $table->string('typeServicesRecherche')->nullable();
            $table->string('DatChangementOperateur')->nullable();
            $table->string('commentaireParticulier')->nullable();
        });
    }
    

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('leads', function (Blueprint $table) {
            $table->dropColumn([
                'entreprise',
                'gerantNonSalarie',
                'nombreDeSalarie',
                'lange',
                'activite',
                'modeChauffage',
                'fournisseurGaz',
                'fournisseurElectrecite',
                'coutGaz',
                'coutElectrecite',
                'salarie',
                'datSalarie',
                'thematiqueDinteret',
                'lange2',
                'maison',
                'interetAmeliorationHabitat',
                'fonctionEntreprise',
                'operationActuel',
                'nombreLineConcernees',
                'telephonFix',
                'telephonMobile',
                'typeServicesRecherche',
                'DatChangementOperateur',
                'commentaireParticulier'
            ]);
        });
    }
};
