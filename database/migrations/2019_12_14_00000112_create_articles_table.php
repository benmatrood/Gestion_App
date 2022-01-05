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
            $table->string('name');
            $table->string('serie_number');	
            $table->boolean('is_available')->default(1);// 1 si disponible, 0 si non disponible
            $table->string('image_url')->nullable();
            $table->foreignId('type_article_id')->contrainte('type_articles');
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
        // supprimé la contrainte au niveau des clés étrangères
        Schema::table('articles', function (Blueprint $table) {
            $table->dropForeign(['type_article_id']);
        });
        Schema::dropIfExists('articles');
    }
}
