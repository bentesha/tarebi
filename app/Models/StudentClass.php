<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentClass extends Model {

    protected $table = 'students_classes';

    use HasFactory;

    protected $casts = [
        'joined_on' => 'date',
        'end_date' => 'date'
    ];

    public function student() {
        return $this->belongsTo(Student::class);
    }
}
