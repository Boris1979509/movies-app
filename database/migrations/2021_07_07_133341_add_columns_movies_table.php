<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

/**
 * Class AddColumnsMoviesTable
 */
class AddColumnsMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('movies', static function (Blueprint $table) {
            $table->string('rating_kinopoisk')->nullable()->after('premiere_world');
            $table->string('rating_imdb')->nullable()->after('rating_kinopoisk');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('movies', static function (Blueprint $table) {
            $table->dropColumn('rating_kinopoisk');
            $table->dropColumn('rating_imdb');
        });
    }
}
