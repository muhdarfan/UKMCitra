<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
         * 1 User (role: lecturer) has many Citra Subject
         * 1 User (role: student) has 1 Student Information
         */

        Schema::create('users', function (Blueprint $table) {
            $table->string('matric_no')->primary();
            $table->string('name');
            $table->string('email')->unique();
            $table->string('password');
            $table->enum("role", ["student", "lecturer", "admin"]);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
}
