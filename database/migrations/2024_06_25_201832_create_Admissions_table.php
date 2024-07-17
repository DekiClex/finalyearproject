<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdmissionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Admissions', function (Blueprint $table) {
            $table->increments('AdmissionID');
            $table->string('CaseID')->nullable();
            $table->date('AdmissionDate')->nullable();
            $table->string('AdmissionDoctorRefer')->nullable();
            $table->string('AdmissionWard')->nullable();
            $table->string('AdmissionStatus')->nullable();
            $table->mediumText('AdmissionLateReason')->nullable();
            $table->string('AdmissionReferral')->nullable();
            $table->mediumText('AdmissionNotes')->nullable();
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
        Schema::dropIfExists('Admissions');
    }
}
