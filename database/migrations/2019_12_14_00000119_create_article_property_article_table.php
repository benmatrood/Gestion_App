<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlePropertyArticleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('article_property_article', function (Blueprint $table) {
            $table->foreignId('article_id')->constrained();
            $table->foreignId('property_article_id')->constrained();
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
        Schema::table('article_property_article', function (Blueprint $table) {
            $table->dropForeign(['article_id']);
            $table->dropForeign(['property_article_id']);
        });
        Schema::dropIfExists('article_property_article');
    }
}
