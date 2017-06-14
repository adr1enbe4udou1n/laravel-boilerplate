<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SetupUsersTable extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->boolean('active')->after('password')->default(true);

            $table->string('confirmation_token', 100)->after('active')->nullable();
            $table->boolean('confirmed')->after('confirmation_token')->default(false);

            $table->string('locale')->after('remember_token')->nullable();
            $table->string('timezone')->after('locale')->nullable();

            $table->string('slug')->after('timezone')->unique();
            $table->timestamp('last_access_at')->after('slug');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('active');
            $table->dropColumn('confirmed');
            $table->dropColumn('confirmation_token');
            $table->dropColumn('locale');
            $table->dropColumn('timezone');
            $table->dropColumn('slug');
            $table->dropColumn('last_access_at');
        });
    }
}
