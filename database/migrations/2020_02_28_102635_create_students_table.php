<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateStudentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('login_id')->nullable();
            $table->unsignedBigInteger('class_id');
            $table->string('nis', 60);
            $table->string('nisn', 60)->nullable();
            $table->string('name', 60);
            $table->string('pob', 60)->nullable();
            $table->date('dob')->nullable();
            $table->boolean('gender_id');
            $table->unsignedTinyInteger('religion_id');
            $table->string('phone', 14)->nullable();
            $table->string('email', 60)->nullable();
            $table->string('address')->nullable();
            $table->string('father_name', 60)->nullable();
            $table->string('father_phone', 14)->nullable();
            $table->string('mother_name', 60)->nullable();
            $table->string('mother_phone', 14)->nullable();
            $table->string('wali_name', 60)->nullable();
            $table->string('wali_relation', 60)->nullable();
            $table->string('wali_phone', 14)->nullable();
            $table->boolean('is_active')->default(1); // 1:active, 0:suspended
            $table->unsignedBigInteger('creator_id');
            $table->timestamps();

            $table->foreign('class_id')->references('id')->on('class_names')->onDelete('restrict');
            $table->foreign('creator_id')->references('id')->on('users')->onDelete('restrict');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('students');
    }
}
