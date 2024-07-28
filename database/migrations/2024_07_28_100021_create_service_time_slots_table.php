<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('service_time_slots', function (Blueprint $table) {
            $table->id();
            $table->string('provider_id');
            $table->unsignedBigInteger('service_id');
            $table->string('day');
            $table->time('from');
            $table->time('to');
            $table->string('slots');
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
        Schema::dropIfExists('service_time_slots');
    }
};
