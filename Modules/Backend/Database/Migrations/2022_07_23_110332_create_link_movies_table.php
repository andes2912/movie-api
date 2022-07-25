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
        Schema::create('link_movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('movie_id');
            $table->string('url_movie');
            $table->boolean('is_active')->default(0);
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('movie_id')
                ->references('id')
                ->on('movies')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('created_by')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');

            $table->foreign('updated_by')
                ->references('id')
                ->on('users')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('link_movies');
    }
};
