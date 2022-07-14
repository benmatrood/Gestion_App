<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLivraisonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('livraisons', function (Blueprint $table) {
            $table->id();
            $table->date('date_livraison');
            $table->time('heure_livraison')->default('00:00:00');
            $table->foreignId('commande_id')->constrained('commandes');
            $table->foreignId('user_id')->constrained('users');
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
        Schema::table('livraisons', function (Blueprint $table) {
            $table->dropForeign(['commande_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('livraisons');
    }
}
