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
        Schema::table('reviews', function (Blueprint $table) {
            $table->foreignId('departement_id')->constrained('departements')->onDelete('cascade');
            $table->foreignId('thematique_id')->constrained('thematiques')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('reviews', function (Blueprint $table) {
            $table->dropForeign(['departement_id']); // Drop the foreign key constraint
            $table->dropForeign(['thematique_id']);  // Drop the foreign key constraint
            $table->dropColumn('departement_id');    // Drop the column
            $table->dropColumn('thematique_id'); 
        });
    }
};
