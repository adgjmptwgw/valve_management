<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHistoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Histories', function (Blueprint $table) {
            $table->id();
            $table->string('valve_name');
            $table->string('valve_number');
            $table->string('valve_usually_state');
            $table->string('valve_state');
            $table->string('valve_memo')->nullable();
            $table->string('operator')->nullable();
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
        Schema::dropIfExists('Histories');
    }
}
