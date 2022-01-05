<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePricingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pricings', function (Blueprint $table) {
            $table->id();
            $table->double('price');
            $table->foreignId('rental_periode_id')->constrained('rental_periodes'); //clé étrangère sur la table rental_periodes
            $table->foreignId('article_id')->constrained();//clé étrangère sur la table articles
            $table->timestamps();
        });

        // activer la contrainte au niveau des clés étrangères
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // supprimer la contrainte au niveau des clés étrangères avant de suprimmer la table pricings
        Schema::table('pricings', function (Blueprint $table) {
            $table->dropForeign(['rental_periode_id']);
            $table->dropForeign(['article_id']);
        });
        Schema::dropIfExists('pricings');
    }
}
