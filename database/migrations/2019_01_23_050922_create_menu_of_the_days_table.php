<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMenuOfTheDaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('menu_of_the_days', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('date_id');
            $table->foreign('date_id')->references('id')->on('dates')->onDelete('cascade');
            $table->unsignedInteger('food_item_id');
            $table->foreign('food_item_id')->references('id')->on('food_items')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('menu_of_the_days');
    }
}
