<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeUserAuthenticationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_user_authentication', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('uid');
            $table->string('real_name', 255)->comment('真实姓名');
            $table->string('mobile', 11)->comment('手机号');
            $table->string('school', 255)->comment('学校')->nullable();
            $table->string('major', 100)->comment('专业')->nullable();
            $table->string('grade', 30)->comment('年级')->nullable();
            $table->date('birthday')->comment('生日')->nullable();
            $table->tinyInteger('certification_status')->comment('认证状态')->default('0');
            $table->timestamp('certification_time')->comment('认证时间')->nullable();
            $table->string('zhifubao_account', 30)->comment('支付宝账号')->nullable();
            $table->string('certification_picture', 300)->comment('证件图片')->nullable();
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
        Schema::drop('banke_user_authentications');
    }
}
