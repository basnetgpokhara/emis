<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Classes extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'numeric_name',
        'section',
        'description',
    ];

    public function students()
    {
        return $this->hasMany(Student::class, 'class_id');
    }

    public function subjects()
    {
        return $this->hasMany(Subject::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }
}