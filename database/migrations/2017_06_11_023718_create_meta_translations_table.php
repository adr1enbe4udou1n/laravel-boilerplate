<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMetaTranslationsTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('meta_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('meta_id')->unsigned();
            $table->string('locale')->index();
            $table->string('title')->nullable();
            $table->text('description')->nullable();

            $table->unique(['meta_id', 'locale']);
            $table->foreign('meta_id')->references('id')
                ->on('meta_translations')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('meta_translations');
    }
}
