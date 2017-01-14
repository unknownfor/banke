<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeCheckInsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_check_in', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('uid')->comment('学生id');
            $table->integer('lesson_id')->comment('课堂id');
            $table->double('award_amount')->comment('奖励金额');
            $table->string('comment')->nullable()->comment('备注');
            $table->integer('operator_uid')->comment('操作人id');
            $table->tinyInteger('status')->comment('有效状态')->default('1');
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
        Schema::drop('banke_check_ins');
    }
}
