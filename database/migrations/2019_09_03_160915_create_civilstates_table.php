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
     */
    public function up()
    {
        Schema::create('civilstates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('state_description', 100);
            $table->integer('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('civilstates');
    }
}
