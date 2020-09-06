<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateValveOptionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ValveOptions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('valve_name');
            $table->string('valve_state')->nullable();
            $table->string('valve_lock')->nullable();
            $table->string('valve_memo')->nullable();
            $table->string('operator')->nullable();
            $table->timestamps();
        });

        // DB::statement("ALTER TABLE " . DB::getTablePrefix() . "ValveOptions COMMENT '弁のオプション'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ValveOptions');
    }
}
