<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banke_user_profiles', function (Blueprint $table) {
            //
            $table->string("mobile", 11)->after('name');
            $table->string("sex", 10)->after('name');
            $table->string("avatar", 100)->after('name');
            $table->dropColumn('school');
            $table->dropColumn('grade');
            $table->dropColumn('major');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banke_user_profiles', function (Blueprint $table) {
            //
        });
    }
}
