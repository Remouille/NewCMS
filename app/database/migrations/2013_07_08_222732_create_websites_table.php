<?php

use Illuminate\Database\Migrations\Migration;

class CreateWebsitesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('websites', function($table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->string('description', 256);
            $table->string('ga', 16);
            $table->integer('user_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('websites');
    }

}