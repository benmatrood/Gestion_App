<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->double('payment_amount');
            $table->datetime('payment_date');
            $table->foreignId('user_id')->constrained();
            $table->foreignId('rental_id')->constrained();
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
        // Supprimé la contrainte au niveau des clés étrangères
        Schema::table('payments', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropForeign(['rental_id']);
        });
        Schema::dropIfExists('payments');
    }
}
