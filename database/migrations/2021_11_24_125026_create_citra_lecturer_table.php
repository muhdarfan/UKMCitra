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

        Schema::create('citra_lecturer', function (Blueprint $table) {
            $table->string("matric_no")->primary();
            $table->foreign('matric_no')->references('matric_no')->on('users');

            //$table->foreignId('citra_id')->constrained('citras')->onDelete('cascade');
            //$table->primary(['matric_no', 'citra_id']);
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
