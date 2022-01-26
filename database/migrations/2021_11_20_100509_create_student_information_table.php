<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentInformationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * One To One Relationship
         * 1 Student has 1 Student Information
         */

        Schema::create('student_information', function (Blueprint $table) {
            $table->string('matric_no')->primary();
            $table->string('faculty');
            $table->string('program_code');
            $table->integer('credit_limit');
            $table->string('session_enter');

            $table->foreign('matric_no')->references('matric_no')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('student_information');
    }
}
