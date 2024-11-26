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
        Schema::table('commandes', function($table) {
            $table->foreignId('lead_id')->constrained('leads')->nullable();
        });
		
		Schema::table('commandes', function (Blueprint $table) {
            $table->unsignedBigInteger('lead_id')->nullable();
            $table->foreign('lead_id')->references('id')->on('leads');
      
        });
		
    }
   
    

    /**
     * Reverse the migrations.
     */
    public function down()
    {

		Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['lead_id']);
            $table->dropColumn('lead_id');
        });
		
    }
};
