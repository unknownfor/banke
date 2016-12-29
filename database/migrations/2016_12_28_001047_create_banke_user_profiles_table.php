<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeUserProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_user_profiles', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->integer('uid')->comment('用户id');
            $table->string('name', 255)->comment('用户名');
            $table->string('school', 255)->comment('学校')->nullable();
            $table->string('major', 100)->comment('专业')->nullable();
            $table->string('grade', 30)->comment('年级')->nullable();
            $table->tinyInteger('certification_status')->comment('认证状态')->default('0');
            $table->timestamp('certification_time')->comment('认证时间');
            $table->integer('account_balance')->comment('账户余额')->default('0');
            $table->integer('total_cashback_amount')->comment('返现总金额')->default('0');
            $table->integer('remaining_cashback_amount')->comment('剩余返现金额')->default('0');
            $table->integer('withdrawal_amount')->comment('已提现金额')->default('0');
            $table->integer('invitation_count')->comment('邀请注册的人数')->default('0');
            $table->integer('invitation_uid')->comment('我的邀请人id')->default('0');
            $table->integer('percentage_cashback_days')->comment('按百分比返现的天数')->default('0');
            $table->integer('percentage_cashback_proportion')->comment('按百分比返现的比例')->default('0');
            $table->timestamp('cashback_start_time')->comment('第一次返现时间');
            $table->timestamp('percentage_cashback_end_time')->comment('百分比返现结束时间');
            $table->integer('register_amount')->comment('注册认证领取的金额')->default('0');
            $table->integer('invitation_amount')->comment('邀请人注册认证领取的金额')->default('0');

            $table->primary('uid');
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
        Schema::drop('banke_user_profiles');
    }
}
