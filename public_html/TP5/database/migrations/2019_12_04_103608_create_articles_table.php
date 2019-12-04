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
            $table->bigIncrements('id');
            $table->string('Titre',40);
            $table->string('Auteur',40);
            $table->date('Date_Publication');
            //$table->date('Date_Modification');
            $table->string('Rubrique',40);
            $table->string('Phrase_accroche',180);
            $table->string('Contenu_textuel',1118);
            $table->boolean('Publié');
            $table->timestamps();

            $table->foreign('Auteur')->references('user')->on('UserEloquent');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
