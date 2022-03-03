<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Admission extends Model {

    use HasFactory;

    protected $casts = [
        'opening_date' => 'date',
        'closing_date' => 'date'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user()->id;
        });
    }

    public function applications() {
        return $this->hasMany(AdmissionApplication::class);
    }

    public function campaigns() {
        return $this->hasMany(AdmissionCampaign::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function program() {
        return $this->belongsTo(Program::class);
    }
}
