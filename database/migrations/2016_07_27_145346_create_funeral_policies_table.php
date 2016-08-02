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
            $table->bigInteger('sum_assured');
            $table->bigInteger('sum_assured_original');
            $table->text('periodic_premium');
            $table->bigInteger('underwriting_premium');
            $table->text('underwriting');
            $table->bigInteger('staff_discount');
            $table->integer('status');
            $table->string('payment_frequency', 32);
            $table->string('mode_of_payment', 32);
            $table->string('automatic_update_percentage', 5);
            $table->dateTime('next_automatic_update');
            $table->string('accidental_rider', 4);
            $table->bigInteger('accidental_rider_premium');
            $table->bigInteger('original_accidental_rider_premium');
            $table->string('family_rider', 4);
            $table->text('family_members');
            $table->dateTime('issue_date');
            $table->integer('branch_id');
            $table->integer('agent_id');
            $table->text('trustee');
            $table->text('bank');
            $table->text('beneficiaries');
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
