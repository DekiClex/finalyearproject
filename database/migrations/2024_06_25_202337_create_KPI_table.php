<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateKPITable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('KPI', function (Blueprint $table) {
            $table->increments('KPIID');
            $table->string('AdmissionID')->nullable();
            $table->integer('KPIsuccess')->nullable();
            $table->integer('KPIfail')->nullable();
            $table->double('KPItotalFundAid')->nullable();
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
        Schema::dropIfExists('KPI');
    }
}
