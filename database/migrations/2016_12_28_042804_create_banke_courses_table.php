<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_course', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->comment('课程名');
            $table->integer('org_id')->comment('机构id');
            $table->string('cover', 100)->comment('封面')->nullable();
            $table->integer('price')->comment('价格')->default('0');
            $table->integer('sort')->comment('排序')->default('0');
            $table->string('intro',150)->comment('简介')->nullable();
            $table->text('details')->comment('详情')->nullable();
            $table->tinyInteger("status")->default('1');
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
        Schema::drop('banke_courses');
    }
}
