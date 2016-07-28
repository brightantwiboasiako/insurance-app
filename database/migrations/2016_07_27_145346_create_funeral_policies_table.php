<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFuneralPoliciesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('funeral_policies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('policy_number', 16);
            $table->integer('customer_id');
            $table->string('staff_id', 16);
            $table->integer('identifier');
            $table->bigInteger('sum_assured', 20);
            $table->bigInteger('sum_assured_original', 20);
            $table->bigInteger('basic_period_premium', 20);
            $table->bigInteger('underwriting_premium', 20);
            $table->bigInteger('staff_discount', 20);
            $table->integer('status');
            $table->integer('payment_frequency');
            $table->integer('mode_of_payment');
            $table->integer('automatic_update_percentage');
            $table->dateTime('next_automatic_update');
            $table->integer('accident_rider');
            $table->bigInteger('accident_rider_premium', 20);
            $table->bigInteger('original_accident_rider_premium', 20);
            $table->integer('family_rider');
            $table->text('family_members');
            $table->dateTime('issue_date');
            $table->integer('branch_id');
            $table->integer('agent_id');
            $table->text('trustee');
            $table->text('bank_information');
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
        Schema::drop('funeral_policies');
    }
}
