<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Churchjobs extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('churchjobs', function (Blueprint $table) { 
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('churchjob');
            $table->integer('hierarchy_id')->unsigned();
            $table->foreign('hierarchy_id')->references('id')->on('hierarchies')->nullable();
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
        Schema::dropIfExists('churchjobs');
    }
}
