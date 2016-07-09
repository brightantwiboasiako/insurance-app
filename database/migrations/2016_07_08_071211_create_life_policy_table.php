<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLifePolicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('life_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('policy_number');
            $table->integer('customer_id');
            $table->string('staff_id');
            $table->integer('identifier')->default(3);
            $table->bigInteger('sum_assured');
            $table->bigInteger('underwriting_premium');
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
        Schema::drop('life_policies');
    }
}
