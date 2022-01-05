<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertyArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('property_articles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('is_required')->default(1);	
            $table->foreignId('type_article_id')->constrained('type_articles');
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
        // Suprimé la contrainte au niveau des clés étrangères
        Schema::table('property_articles',function (Blueprint $table){
            $table->dropForeign(['type_article_id']);
        });
        Schema::dropIfExists('property_articles');
    }
}
