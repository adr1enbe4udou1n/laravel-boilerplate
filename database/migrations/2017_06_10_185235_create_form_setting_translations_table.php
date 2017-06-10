<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormSettingTranslationsTable extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('form_setting_translations',
            function (Blueprint $table) {
                $table->increments('id');
                $table->integer('form_setting_id')->unsigned();
                $table->string('locale')->index();
                $table->text('message')->nullable();

                $table->unique(['form_setting_id', 'locale']);
                $table->foreign('form_setting_id')->references('id')->on('form_settings')
                    ->onDelete('cascade');
            });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('form_setting_translations');
    }
}
