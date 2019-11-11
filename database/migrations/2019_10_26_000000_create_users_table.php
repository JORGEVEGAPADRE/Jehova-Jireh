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
            $table->engine = 'InnoDB';
            $table->increments('id');            
            $table->string('name');
            $table->string('lastname')->nullable();
            $table->string('role')->default('guest');
            $table->integer('country_id')->nullable()->unsigned();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->integer('sex_id')->nullable()->unsigned();
            $table->foreign('sex_id')->references('id')->on('genders');
            $table->integer('bloodtype_id')->nullable()->unsigned();
            $table->foreign('bloodtype_id')->references('id')->on('bloodtypes');
            $table->datetime('birthdate')->nullable();
            $table->string('rut')->unique()->nullable();    
            $table->integer('civilstate_id')->nullable()->unsigned();
            $table->foreign('civilstate_id')->references('id')->on('civilstates');
            $table->integer('jobstate_id')->nullable()->unsigned();
            $table->foreign('jobstate_id')->references('id')->on('jobstates');           
            $table->string('occupation')->nullable();
            $table->datetime('newbirthdate')->nullable();
            $table->datetime('baptizeddate')->nullable();
            $table->string('lifetestimony')->nullable(); 
            $table->string('email')->unique();
            $table->string('alternateemail')->nullable();
            $table->string('phone')->nullable();
            $table->string('address')->nullable();
            $table->string('notes')->nullable();
            $table->integer('hierarchy_id')->nullable()->unsigned();
            $table->foreign('hierarchy_id')->references('id')->on('hierarchies');
            $table->string('password');
            $table->string('confirmpassword')->nullable();           
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
