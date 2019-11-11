<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Bloodtypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('bloodtypes', function (Blueprint $table) { 
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('bloodtype');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
   
    public function down()
    {
        Schema::dropIfExists('bloodtypes');
    }
}
