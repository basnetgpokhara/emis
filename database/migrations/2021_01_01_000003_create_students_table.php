<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStudentsTable extends Migration
{
    public function up()
    {
        Schema::create('students', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('admission_no')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob');
            $table->string('phone', 20);
            $table->string('email')->nullable();
            $table->text('address')->nullable();
            $table->string('guardian_name');
            $table->string('guardian_phone', 20);
            $table->foreignId('class_id')->nullable()->constrained('classes')->onDelete('set null');
            $table->string('section', 10)->nullable();
            $table->string('roll_no', 20)->nullable();
            $table->enum('status', ['active', 'inactive', 'graduated', 'transferred'])->default('active');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('students');
    }
}