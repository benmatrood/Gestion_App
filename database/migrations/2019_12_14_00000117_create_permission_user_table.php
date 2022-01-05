<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePermissionUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('permission_user', function (Blueprint $table) {
            $table->foreignId('permission_id')->constrained();
            $table->foreignId('user_id')->constrained();
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
        Schema::table('permission_user', function (Blueprint $table) {
            $table->dropForeign(['permission_id']);
            $table->dropForeign(['user_id']);
        });
        Schema::dropIfExists('permission_user');
    }
}
