<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateElsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('els', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('type_id')->unsigned();
           $table->integer('user_id')->unsigned();
           $table->foreign('type_id')->references('id')->on('elantypes');
           $table->string('title');
           $table->boolean('status');
           $table->text('about');
           $table->string('location');
           $table->string('lat');
           $table->string('lng');
           $table->string('name');
           $table->string('phone');
           $table->string('email');
           $table->string('image');
           $table->string('org');
           $table->string('nov');
           $table->date('deadline');
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
        Schema::drop('els');
    }
}
