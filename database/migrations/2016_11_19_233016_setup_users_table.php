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

            $table->string('locale')->after('remember_token')->default('');
            $table->string('timezone')->after('locale')->default('');

            $table->string('slug')->after('timezone')->default('')->unique();
            $table->timestamp('last_access_at')->after('slug')->nullable();
        });

        Schema::table('users', function (Blueprint $table) {
            $table->string('password')->nullable()->change();
            $table->string('locale')->default(null)->change();
            $table->string('timezone')->default(null)->change();
            $table->string('slug')->default(null)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'active',
                'locale',
                'timezone',
                'slug',
                'last_access_at',
            ]);
        });
    }
}
