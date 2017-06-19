<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTagsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('tags', function (Blueprint $table) {
            $table->increments('id');
            $table->string('locale');
            $table->string('name');
            $table->string('slug')->unique();
        });

        Schema::create('taggables', function (Blueprint $table) {
            $table->increments('id');
            $table->morphs('taggable');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('tags');
        Schema::dropIfExists('taggables');
    }
}
