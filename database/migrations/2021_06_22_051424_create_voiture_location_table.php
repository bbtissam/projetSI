<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoitureLocationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voiture_location', function (Blueprint $table) {
            $table->foreignId("voiture_id")->constrained();
            $table->foreignId("location_id")->constrained();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('voiture_location', function(Blueprint $table){
            $table->dropForeign(["voiture_id", "location_id"]);
        });

        Schema::dropIfExists('voiture_location');
    }
}
