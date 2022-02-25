<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionApplication extends Model {

    use HasFactory;

    protected $casts = [
        'date_of_birth' => 'date'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user() != null ? auth()->user()->id : 0;
        });
    }

    public function admission() {
        return $this->belongsTo(Admission::class);
    }

    public function comments() {
        return $this->hasMany(ApplicationComment::class);
    }

    public function assessment() {
        return $this->hasOne(Assessment::class);
    }
}