<?php

use Illuminate\Database\Migrations\Migration;

class CreateContentsTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contents', function($table) {
            $table->increments('id');
            $table->string('tag', 16);
            $table->string('content', 1024);
            $table->integer('page_id')->unsigned();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('contents');
    }

}