<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQarsiliqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('qarsiliqs', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('user_id');
          $table->integer('elan_id')->unsigned();
          $table->text('description');
          $table->boolean('status');
          $table->boolean('feedback');
          $table->boolean('notification');
          $table->boolean('data');
          $table->boolean('data_status');
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
        Schema::drop('qarsiliqs');
    }
}
