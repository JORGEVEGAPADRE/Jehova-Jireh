<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCivilStatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     * 
     * 
     */
    public function up()
    {
        Schema::create('civilstates', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('statedescription');
            $table->timestamps();
        });
    }    
     /* 
     * Reverse the migrations.
     */
    public function down()
    {
        Schema::dropIfExists('civilstates');
    }
    
}     