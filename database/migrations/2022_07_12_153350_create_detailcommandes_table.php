<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailcommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detailcommandes', function (Blueprint $table) {
            $table->id();
            $table->integer('quantite');
            $table->integer('nombre_point');
            $table->date('date_commande');
            $table->time('heure_commande')->default('00:00:00');
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
        Schema::table('detailcommandes', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropForeign(['commande_id']);
        });
        Schema::dropIfExists('detailcommandes');
    }
}
