<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCommandesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('commandes', function (Blueprint $table) {
            $table->id();
            $table->date('date_commande');
            $table->time('time')->default('00:00');
            $table->integer('quantite');
            $table->integer('nombre_point');
            $table->foreignId('user_id')->constrained('users');
            $table->foreignId('boutique_id')->constrained('boutiques');
            $table->foreignId('client_id')->constrained('clients');
            $table->foreignId('statutcommande_id')->constrained('statutcommandes');
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
        Schema::table('commandes', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['boutique_id']);
            $table->dropForeign(['client_id']);
            $table->dropForeign(['statutcommande_id']);
        });
        Schema::dropIfExists('commandes');
    }
}
