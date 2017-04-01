<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

          Schema::create('messages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email');
            $table->string('username');
            $table->string('message');
          
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
        //
    }
}
