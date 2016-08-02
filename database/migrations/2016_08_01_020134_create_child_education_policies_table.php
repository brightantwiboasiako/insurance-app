<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChildEducationPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('child_education_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('policy_number', 20)->unique();
            $table->bigInteger('sum_assured');
            $table->bigInteger('premium');
            $table->integer('customer_id')->unsigned();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
            $table->mediumText('children');
            $table->text('underwriting');
            $table->text('trustee');
            $table->string('mode_of_payment', 32);
            $table->string('payment_frequency', 32);
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
        Schema::drop('child_education_policies');
    }
}
