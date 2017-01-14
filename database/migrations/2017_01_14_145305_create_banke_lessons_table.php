<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeLessonsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_lesson', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('org_account')->comment('机构账户id');
            $table->integer('org_id')->comment('机构id');
            $table->integer('course_id')->comment('课程id');
            $table->timestamp('start_time')->comment('开始打卡时间')->nullable();
            $table->timestamp('end_time')->comment('停止打卡时间')->nullable();
            $table->integer('attendance_count')->comment('实到人数')->default('0');
            $table->integer('check_in_count')->comment('签到人数')->default('0');
            $table->string('check_in_code', 8)->comment('签到密码');
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
        Schema::drop('banke_lessons');
    }
}
