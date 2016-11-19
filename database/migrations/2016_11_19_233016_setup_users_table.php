<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('active')->after('password')->default(true);
            $table->string('last_name')->after('active')->nullable();
            $table->string('first_name')->after('last_name')->nullable();
            $table->tinyInteger('role')->after('first_name')->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropColumn('last_name');
            $table->dropColumn('first_name');
            $table->dropColumn('role');
        });
    }
}
