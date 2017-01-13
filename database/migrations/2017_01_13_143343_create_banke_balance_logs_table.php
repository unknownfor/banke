<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeBalanceLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_balance_logs', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('uid')->comment('学生id');
            $table->double('change_amount')->comment('变动金额');
            $table->string('change_type', 2)->comment('变动类型，+或-');
            $table->string('business_type')->comment('业务类型');
            $table->integer('operator_uid')->comment('操作人id');
            $table->tinyInteger('status')->comment('状态')->default('1');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('banke_balance_logs');
    }
}
