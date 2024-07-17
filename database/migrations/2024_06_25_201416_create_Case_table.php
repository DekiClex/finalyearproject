<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCaseTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('Case', function (Blueprint $table) {
            $table->increments('CaseID');
            $table->string('PatientID');
            $table->string('CaseClassification');
            $table->string('CaseDiagnosis');
            $table->string('CaseZone')->nullable();
            $table->mediumText('CaseNote')->nullable();
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
        Schema::dropIfExists('Case');
    }
}
