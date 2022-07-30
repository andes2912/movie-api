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
        Schema::create('keyword_series', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('series_id');
            $table->string('name');
            $table->timestamps();

            $table->foreign('series_id')
                ->references('id')
                ->on('series')->onDelete('cascade')->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('keyword_series');
    }
};
