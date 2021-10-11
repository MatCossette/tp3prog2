<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMealsTable extends Migration
{

    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('meals', function (Blueprint $table) {
            $table->id();
            $table->string('description');
            $table->string('image');
            $table->integer('meteo');
            $table->unsignedBigInteger('user_id');
            $table->tinyInteger('is_reserved');
            $table->timestamp('created_at');
            $table->timestamp('updated_at');

            $table->foreign('user_id')
                ->references('id')
                ->on('users')
                ->onDelete('cascade');
        });
        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meals');
    }
}
