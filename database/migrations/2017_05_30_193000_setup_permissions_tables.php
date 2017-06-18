<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class SetupPermissionsTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @throws \Exception
     */
    public function up()
    {
        DB::beginTransaction();

        // Create table for storing roles
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->timestamps();
        });

        Schema::create('role_translations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('locale')->index();

            $table->string('display_name')->nullable();
            $table->string('description')->nullable();

            $table->unique(['role_id', 'locale']);
            $table->foreign('role_id')->references('id')
                ->on('role_translations')
                ->onDelete('cascade');
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('role_user', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('role_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade');
            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade');

            $table->primary(['user_id', 'role_id']);
        });

        // Create table for storing permissions
        Schema::create('permissions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id')->unsigned();
            $table->string('name');
            $table->timestamps();

            $table->foreign('role_id')->references('id')->on('roles')
                ->onDelete('cascade');
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::drop('permissions');
        Schema::drop('role_user');
        Schema::drop('roles');
        Schema::drop('role_translations');
    }
}
