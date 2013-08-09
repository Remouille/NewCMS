<?php

use Illuminate\Database\Migrations\Migration;

class CreatePagesTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pages', function($table) {
            $table->increments('id');
            $table->string('title', 128);
            $table->string('description', 256);
            $table->string('url', 128);
            $table->integer('website_id')->unsigned();
            $table->integer('template_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('pages');
    }

}