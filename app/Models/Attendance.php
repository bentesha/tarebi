<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Attendance extends Model {

    use HasFactory;

    protected $casts = [
        'date' => 'date'
    ];

    public function engagement() {
        return $this->belongsTo(Engagement::class);
    }

    public function enrollmentClass() {
        return $this->belongsTo(EnrollmentClass::class, 'class_id');
    }

    public function students() {
        return $this->belongsToMany(Student::class, 'students_attendances')
            ->withPivot('attendance');
    }

    public function studentsAttendances() {
        return $this->hasMany(StudentAttendance::class);
    }
}
