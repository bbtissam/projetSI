<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateVoituresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('voitures', function (Blueprint $table) {
            $table->id();
            $table->string("titre");
            $table->string("matricule");
            $table->string("modele");
            $table->string("image")->nullable();
            $table->integer("kilometrage");
            $table->integer("nbrPlace");
            $table->text("description");
            $table->boolean("estDisponible")->default(1);
            $table->foreignId("type_voiture_id")->constrained();
            $table->timestamps();
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
        Schema::table("voitures", function(Blueprint $table){
            $table->dropForeign("type_voiture_id");
        });
        Schema::dropIfExists('voitures');
    }
}
