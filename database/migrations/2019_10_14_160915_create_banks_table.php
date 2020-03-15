<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBanksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('banks', function (Blueprint $table) { 
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('namebank');          
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
        Schema::dropIfExists('banks');
    }
}