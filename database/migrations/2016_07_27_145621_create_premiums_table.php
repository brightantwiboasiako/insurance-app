<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePremiumsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('premiums', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('policy_type');
            $table->string('policy_number', 16);
            $table->bigInteger('amount', 20);
            $table->dateTime('period');
            $table->integer('adequacy_status',);
            $table->string('cheque_number', 16);
            $table->string('receipt_code', 16);
            $table->dateTime('date_received');
            $table->integer('captured_by');
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
        Schema::drop('premiums');
    }
}
