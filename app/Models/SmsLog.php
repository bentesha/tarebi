<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SmsLog extends Model {

    use HasFactory;

    public function campaign() {
        return $this->belongsTo(SmsCampaign::class, 'sms_campaign_id');
    }
}
