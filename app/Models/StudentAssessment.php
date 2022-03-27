<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentAssessment extends Model {

    use HasFactory;

    protected $casts = [
        'assessment' => 'object',
    ];

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
