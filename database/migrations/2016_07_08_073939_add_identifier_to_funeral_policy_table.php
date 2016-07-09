<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdentifierToFuneralPolicyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('funeral_policies', function (Blueprint $table) {
            $table->integer('identifier')->after('staff_id')->default(1);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('funeral_policies', function (Blueprint $table) {
            $table->dropColumn('identifier');
        });
    }
}
