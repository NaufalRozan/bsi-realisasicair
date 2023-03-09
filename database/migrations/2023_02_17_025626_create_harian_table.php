<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHarianTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('harian', function (Blueprint $table) {
            $table->id();
            $table->string('name')->index();
            $table->bigInteger('Realisasi_Cair');
            $table->date('tanggal');
            $table->bigInteger('Total_Pencairan')->nullable();
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
        Schema::dropIfExists('harian');
    }
}
