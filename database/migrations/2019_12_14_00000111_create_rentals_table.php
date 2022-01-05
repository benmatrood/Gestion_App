<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rentals', function (Blueprint $table) {
            $table->id();
            $table->datetime('start_date');
            $table->datetime('end_date');
            $table->foreignId('customer_id')->constrained();
            $table->foreignId('rental_statu_id')->constrained('rental_status');
            $table->foreignId('user_id')->constrained();
        });
          // activer la contrainte au niveau des clés étrangères
          Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return voidar
     */
    public function down()
    {
        // Supprimé la contrainte au niveau des clés étrangères
        Schema::table('rentals', function (Blueprint $table) {
            $table->dropForeign(['customer_id']);
            $table->dropForeign(['rental_statu_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('rentals');
    }
}
