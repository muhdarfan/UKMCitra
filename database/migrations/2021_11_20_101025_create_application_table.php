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
            $table->string('session')->nullable();
            $table->string('semester', 32)->default('1');
            $table->string('matric_no', 32);
            $table->string('courseCode');
            $table->string('reason');
            $table->enum('status', ['approved', 'rejected', 'pending'])->default('pending');

            $table->foreign('matric_no')->references('matric_no')->on('users')->onDelete('cascade');
            $table->foreign('courseCode')->references('courseCode')->on('citras')->onDelete('cascade');

            $table->unique(['session', 'semester', 'matric_no', 'courseCode']);
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
