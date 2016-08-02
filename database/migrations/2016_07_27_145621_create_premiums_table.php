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
            $table->string('business_type', 32);
            $table->string('policy_number', 16);
            $table->bigInteger('amount_expected');
            $table->bigInteger('amount_paid');
            $table->dateTime('period');
            $table->integer('is_complete');
            $table->string('cheque_number', 16)->nullable();
            $table->string('receipt_code', 16);
            $table->dateTime('received_at');
            $table->integer('captured_by', false, true);
            $table->foreign('captured_by')->references('id')->on('users');
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
