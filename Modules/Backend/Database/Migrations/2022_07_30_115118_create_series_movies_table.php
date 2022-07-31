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
        Schema::create('series_movies', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id');
            $table->integer('season');
            $table->integer('episode');
            $table->bigInteger('count');
            $table->unsignedBigInteger('created_by');
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->timestamps();

            $table->foreign('series_id')
                ->references('id')
                ->on('series')->onDelete('cascade')->onUpdate('cascade');

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
        Schema::dropIfExists('series_movies');
    }
};
