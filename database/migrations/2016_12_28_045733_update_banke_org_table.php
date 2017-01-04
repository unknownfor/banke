<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateBankeOrgTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('banke_org', function (Blueprint $table) {
            //
            $table->string("address", 150)->after('sort')->comment('详细地址');
            $table->string("tel_phone", 20)->after('sort')->comment('联系电话');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('banke_org', function (Blueprint $table) {
            //
        });
    }
}
