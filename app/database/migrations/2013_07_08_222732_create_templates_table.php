<?php

use Illuminate\Database\Migrations\Migration;

class CreateTemplatesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('templates', function($table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->string('url', 256);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('templates');
    }

}