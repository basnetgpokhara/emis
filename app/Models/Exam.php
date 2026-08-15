<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Exam extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'exam_type_id',
        'class_id',
        'subject_id',
        'date',
        'total_marks',
        'passing_marks',
    ];

    protected $casts = [
        'date' => 'date',
    ];

    public function examType()
    {
        return $this->belongsTo(ExamType::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function subject()
    {
        return $this->belongsTo(Subject::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }
}