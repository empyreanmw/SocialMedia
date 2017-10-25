<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTrendsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trends', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->unsignedInteger('post_count')->default(1);
            $table->timestamps();
        });

        Schema::create('post_trend', function (Blueprint $table) {
            $table->unsignedInteger('post_id');
            $table->unsignedInteger('trend_id');

            $table->primary(['post_id', 'trend_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('trends');
        Schema::dropIfExists('post_trend');
    }
}
