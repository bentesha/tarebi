<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsCampaign extends Model {

    use HasFactory;

    public static function boot() {
        parent::boot();

        static::creating(function ($model) {
            $model->created_by = auth()->user()->id;
        });
    }

    public function enrollmentClass() {
        return $this->belongsTo(EnrollmentClass::class, 'class_id');
    }

    public function smsTemplate() {
        return $this->belongsTo(SmsTemplate::class);
    }

    public function smsLogs() {
        return $this->hasMany(SmsLog::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }
}
