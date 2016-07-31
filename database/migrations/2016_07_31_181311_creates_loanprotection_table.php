<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreatesLoanprotectionTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('loanprotection', function(Blueprint $table){
            $table->string('policy_number', 20);
            $table->string('institution_name', 64);
            $table->string('institution_branch', 64);
            $table->string('institution_phone', 15);
            $table->string('institution_email', 64);
            $table->string('institution_address');
            $table->longText('borrowers');
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
        Schema::drop('loanprotection');
    }
}
