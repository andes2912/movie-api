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
        Schema::table('keyword_series', function (Blueprint $table) {
            $table->dropForeign('keyword_series_series_id_foreign');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('keyword_series', function (Blueprint $table) {
            $table->dropForeign('keyword_series_series_id_foreign');
        });
    }
};
