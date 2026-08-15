<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTeachersTable extends Migration
{
    public function up()
    {
        Schema::create('teachers', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->nullable()->constrained('users')->onDelete('set null');
            $table->string('employee_id')->unique();
            $table->string('first_name');
            $table->string('last_name');
            $table->enum('gender', ['male', 'female', 'other']);
            $table->date('dob');
            $table->string('phone', 20);
            $table->string('email')->unique();
            $table->text('address')->nullable();
            $table->string('qualification');
            $table->decimal('experience', 4, 1)->nullable()->default(0);
            $table->foreignId('subject_id')->nullable()->constrained('subjects')->onDelete('set null');
            $table->enum('status', ['active', 'inactive'])->default('active');
            $table->string('photo')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('teachers');
    }
}