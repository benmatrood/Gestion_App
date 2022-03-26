<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->id();
            $table->string('nom_article');
            $table->string('reference_article');
            $table->integer('stock')->default(1);
            $table->string('url_image')->nullable();
            $table->text('despription');
            $table->foreignId('groupe_id')->constrained('groupes');
            $table->foreignId('famille_id')->constrained('familles');
            $table->foreignId('sousfamille_id')->constrained('sousfamilles');
            $table->foreignId('palierprivilege_id')->constrained('palierprivileges');
            $table->timestamps();
            
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
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['groupe_id']);
            $table->dropForeign(['famille_id']);
            $table->dropForeign(['sousfamille_id']);
            $table->dropForeign(['palierprivilege_id']);
        });
        Schema::dropIfExists('articles');
    }
}
