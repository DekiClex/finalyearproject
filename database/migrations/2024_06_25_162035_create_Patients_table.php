<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePatientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Patients', function (Blueprint $table) {
            $table->increments('PatientID');
            $table->string('PatientName');
            $table->string('PatientIC')->nullable();
            $table->integer('PatientAge')->nullable();
            $table->date('PatientBirthDate')->nullable();
            $table->string('PatientRace')->nullable();
            $table->string('PatientAddress')->nullable();
            $table->string('PatientUKSP')->nullable();
            $table->string('PatientPCR')->nullable();
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
        Schema::dropIfExists('Patients');
    }
}
