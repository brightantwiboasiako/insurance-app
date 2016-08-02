<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCustomersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('customers', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title', 16);
            $table->string('surname', 64);
            $table->string('first_name', 32);
            $table->string('other_name', 32);
            $table->string('gender', 6);
            $table->date('birth_day');
            $table->string('email', 1024);
            $table->string('primary_phone_number', 15);
            $table->string('occupation', 124);
            $table->string('employer_name', 64);
            $table->string('employer_address', 1024);
            $table->string('personal_address', 1024);
            $table->integer('created_by');
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
        Schema::drop('customers');
    }
}
