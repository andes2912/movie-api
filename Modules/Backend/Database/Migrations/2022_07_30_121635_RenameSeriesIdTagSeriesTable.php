<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('tag_series', function (Blueprint $table) {
            $table->renameColumn('series_id','series_movie_id');

            $table->foreign('series_movie_id')
                ->references('id')
                ->on('series_movies')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('tag_series', function (Blueprint $table) {
           $table->renameColumn('series_movie_id','series_id');
        });
    }
};
