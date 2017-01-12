<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeWithdrawsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_withdraw', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('uid')->comment('学生id');
            $table->double('withdraw_amount')->comment('提现金额');
            $table->string('zhifubao_account')->comment('支付宝账号');
            $table->tinyInteger('status')->comment('状态')->default('0');
            $table->integer('operator_uid')->comment('操作人id');
            $table->string('processing_result')->comment('处理结果')->nullable();
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
        Schema::drop('banke_withdraws');
    }
}
