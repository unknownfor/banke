<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeCashBackUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_cash_back_users', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('uid')->comment('用户id');
            $table->integer('org_id')->comment('机构id');
            $table->integer('course_id')->comment('课程id');
            $table->integer('tuition_amount')->default('0')->comment('学费金额');
            $table->integer('cash_back_amount')->default('0')->comment('返现金额');
            $table->integer('operator_uid')->comment('操作人id');
            $table->integer('status')->default('0');
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
        Schema::drop('banke_cash_back_users');
    }
}
