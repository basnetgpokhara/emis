<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->id();
            $table->foreignId('student_id')->constrained('students')->onDelete('cascade');
            $table->foreignId('exam_id')->constrained('exams')->onDelete('cascade');
            $table->foreignId('subject_id')->constrained('subjects')->onDelete('cascade');
            $table->decimal('marks_obtained', 6, 2);
            $table->string('grade', 2)->nullable();
            $table->timestamps();
            $table->unique(['student_id', 'exam_id', 'subject_id']);
        });
    }

    public function down()
    {
        Schema::dropIfExists('results');
    }
}