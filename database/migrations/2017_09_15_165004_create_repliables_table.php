<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRepliablesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('replies', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->text('body');
            $table->unsignedInteger('replied_id');
            $table->string('replied_type');
            $table->timestamps();

            //$table->unique(['user_id', 'replied_id', 'replied_type']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('replies');
    }
}
