<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'admission_no',
        'first_name',
        'last_name',
        'gender',
        'dob',
        'phone',
        'email',
        'address',
        'guardian_name',
        'guardian_phone',
        'class_id',
        'section',
        'roll_no',
        'status',
        'photo',
    ];

    protected $casts = [
        'dob' => 'date',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function class()
    {
        return $this->belongsTo(Classes::class, 'class_id');
    }

    public function attendances()
    {
        return $this->hasMany(Attendance::class);
    }

    public function results()
    {
        return $this->hasMany(Result::class);
    }

    public function fees()
    {
        return $this->hasMany(Fee::class);
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function getFullNameAttribute()
    {
        return $this->first_name . ' ' . $this->last_name;
    }
}