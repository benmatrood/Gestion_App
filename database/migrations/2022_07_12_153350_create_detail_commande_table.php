<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailCommandeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_commande', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->integer('nombre_point');
            $table->foreignId('article_id')->constrained('articles');
            $table->foreignId('commande_id')->constrained('commandes');
        });
        // activer la clef etrangere
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('detail_commande', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropForeign(['commande_id']);
        });
        Schema::dropIfExists('detail_commande');
    }
}
