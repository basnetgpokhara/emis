<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAttendanceTable extends Migration
{
    public function up()
    {
        Schema::create('attendance', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('class_id')->constrained('classes')->onDelete('cascade');
            $table->date('date');
            $table->enum('status', ['present', 'absent', 'late', 'holiday']);
            $table->text('remark')->nullable();
            $table->timestamps();
            $table->unique(['student_id', 'class_id', 'date']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('attendance');
    }
}