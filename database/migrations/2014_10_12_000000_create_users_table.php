<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     * protected $fillable = [
 
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {            

            $table->increments('id');            
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('role')->default('guest');
            $table->integer('country_id')->references('id')->on('countrys')->nullable();
            $table->string('sex')->references('id')->on('sexs')->nullable();
            $table->integer('bloodtype_id')->references('id')->on('bloodtypes')->nullable();
            $table->datetime('birth_date')->nullable();;
            $table->string('rut')->nullable();
            $table->integer('civilstate_id')->references('id')->on('civilstates')->nullable();
            $table->integer('jobstate_id')->references('id')->on('jobstates')->nullable();
            $table->string('occupation')->nullable();
            $table->datetime('new_birth_date')->nullable();
            $table->datetime('baptized_date')->nullable();
            $table->string('life_testimony')->nullable(); 
            $table->string('email')->unique();         
           
            $table->string('alternate_email')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('notes')->nullable();
            $table->string('password');       
            
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
