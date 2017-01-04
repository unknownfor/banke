<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeOrgsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banke_org', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name', 255)->comment('机构名');
            $table->string('logo', 255)->comment('机构logo');
            $table->string('city', 100)->comment('城市');
            $table->string('cover', 1000)->comment('封面')->nullable();
            $table->integer('sort')->comment('排序')->default('0');
            $table->string('intro',150)->comment('简介');
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
        Schema::drop('banke_orgs');
    }
}
