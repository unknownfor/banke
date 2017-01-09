<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeEnrolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_enrol', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name')->comment('姓名');
            $table->string('mobile',11)->comment('手机号');
            $table->integer('org_id')->comment('机构id');
            $table->integer('course_id')->comment('课程id');
            $table->tinyInteger('status')->comment('状态')->default('0');
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
        Schema::drop('banke_enrols');
    }
}
