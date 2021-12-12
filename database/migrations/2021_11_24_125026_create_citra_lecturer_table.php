<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitraLecturerTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * One To Many Relationship
         * 1 User (role: lecturer) has many Citra Subject
         */

        Schema::create('citras_lecturer', function (Blueprint $table) {
            $table->string("matric_no");
            $table->string("courseCode");

            $table->foreign('matric_no')->references('matric_no')->on('users')->onDelete('cascade');
            $table->foreign('courseCode')->references('courseCode')->on('citras')->onDelete('cascade');
            $table->primary(['matric_no', 'courseCode']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('citra_lecturer');
    }
}
