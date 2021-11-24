<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateApplicationTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('application', function (Blueprint $table) {
            $table->id('application_id');
            $table->string('matric_no');
            $table->string('courseCode');
            $table->string('reason');
            $table->string('status');
            $table->string('semester');

            $table->foreign('matric_no')->references('matric_no')->on('users')->onDelete('cascade');
            $table->foreign('courseCode')->references('courseCode')->on('citras')->onDelete('cascade');
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
        Schema::dropIfExists('application');
    }
}
