<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EnrollmentClass extends Model {

    protected $table = 'classes';

    use HasFactory;

    protected $casts = [
        'start_date' => 'date',
        'end_date' => 'date'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->program_id = $model->admission->program_id;
        });
    }

    public function admission() {
        return $this->belongsTo(Admission::class);
    }

    public function setAdmissionProgram() {
        return $this->admission->program->name;
    }
}
