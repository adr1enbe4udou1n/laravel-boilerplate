<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FavouritesTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('favourites', function (Blueprint $table) {
            $table->morphs('model');
            $table->integer('user_id')->nullable()->unsigned();
            $table->timestamp('created_at');

            $table->primary(['user_id', 'model_type', 'model_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('favourites');
    }
}
