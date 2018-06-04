<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDetailBookingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_bookings', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('booking_id');
            $table->unsignedInteger('lapang_id');
            $table->unsignedInteger('waktu_awal');
            $table->unsignedInteger('waktu_akhir');
            $table->date('tanggal_main');

            $table->foreign('booking_id')->references('id')->on('bookings');
            $table->foreign('lapang_id')->references('id')->on('lapangs');

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
        Schema::dropIfExists('detail_bookings');
    }
}
