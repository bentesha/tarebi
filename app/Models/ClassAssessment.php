<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClassAssessment extends Model {

    use HasFactory;

    protected $casts = [
        'date' => 'date'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user()->id;
        });
    }

    public function enrollmentClass() {
        return $this->belongsTo(EnrollmentClass::class, 'class_id');
    }

    public function assessments() {
        return $this->hasMany(StudentAssessment::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
