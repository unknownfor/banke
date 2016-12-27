<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBankeDictTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::create('banke_dict',function(Blueprint $table){
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('key');
            $table->string('value');
            $table->softDeletes();
            $table->timestamps();
            $table->unique('key');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
