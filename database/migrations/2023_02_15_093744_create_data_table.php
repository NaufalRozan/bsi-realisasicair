<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDataTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('data', function (Blueprint $table) {
            $table->id();
            $table->string('Nama_Marketing');
            $table->string('Outlet');
            $table->bigInteger('Target_Jabatan');
            $table->bigInteger('Total_Cair');
            $table->bigInteger('Pencairan_Baru');
            $table->bigInteger('Pencairan_TopUp');
            $table->bigInteger('Total_Pencairan_Growth');
            $table->float('Persenan');
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
        Schema::dropIfExists('data');
    }
}
