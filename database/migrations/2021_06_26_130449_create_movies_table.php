<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Query\Expression;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('movies', static function (Blueprint $table) {
            $table->id();
            $table->bigInteger('id_kinopoisk')->nullable(false)->unsigned();
            $table->string('url')->nullable();
            $table->string('type')->nullable();
            $table->string('title')->nullable();
            $table->string('title_alternative')->nullable();
            $table->string('tagline')->nullable();
            $table->text('description')->nullable();
            $table->integer('year')->nullable();
            $table->string('poster')->nullable();
            $table->string('trailer')->nullable();
            $table->string('age')->nullable();
            $table->json('actors')->default(new Expression('(JSON_ARRAY())'));
            $table->json('countries')->default(new Expression('(JSON_ARRAY())'));
            $table->json('genres')->default(new Expression('(JSON_ARRAY())'));
            $table->string('budget')->nullable();
            $table->string('premiere_world')->nullable();

            $table->timestamps();
            $table->softDeletes($column = 'deleted_at', $precision = 0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
