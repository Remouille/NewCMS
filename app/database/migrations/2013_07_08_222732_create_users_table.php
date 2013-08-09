<?php

use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function($table) {
            $table->increments('id');
            $table->string('username', 50);
            $table->string('password', 256);
            $table->string('firstname', 50);
            $table->string('lastname', 50);
            $table->string('email', 64);
            $table->string('avatar', 256);
            $table->enum('type', array("admin", "user"));
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('users');
    }

}