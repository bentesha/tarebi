<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AdmissionCampaign extends Model {

    use HasFactory;

    protected $casts = [
        'campaign_date' => 'date'
    ];

    public static function boot() {
        parent::boot();

        static::creating(function ($admission_campaign) {
            $admission_campaign->created_by = auth()->user()->id;
        });
    }

    public function staff() {
        return $this->belongsTo(User::class, 'staff_id');
    }

    public function user() {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function admission() {
        return $this->belongsTo(Admission::class);
    }
}
