<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAttendance extends Model {

    protected $table = 'students_attendances';

    use HasFactory;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user()->id;
        });
    }

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
