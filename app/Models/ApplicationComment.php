<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ApplicationComment extends Model {

    use HasFactory;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->posted_by = auth()->user()->id;
        });
    }

    public function application() {
        return $this->belongsTo(AdmissionApplication::class, 'admission_application_id');
    }

    public function postedBy() {
        return $this->belongsTo(User::class, 'posted_by');
    }
}
