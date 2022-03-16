<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model {

    use HasFactory;

    protected $casts = [
        'date_of_birth' => 'date'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user()->id;
        });
    }

    public function attendances() {
        return $this->hasMany(Attendance::class, 'students_attendances');
    }

    public function admission() {
        return $this->belongsTo(Admission::class);
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
