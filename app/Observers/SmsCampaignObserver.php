<?php

namespace App\Observers;

use App\Models\SmsCampaign;
use App\Models\SmsLog;
use App\Models\Student;

class SmsCampaignObserver {
    /**
     * Handle the SmsCampaign "created" event.
     *
     * @param  \App\Models\SmsCampaign  $smsCampaign
     * @return void
     */
    public function created(SmsCampaign $smsCampaign) {
        $students = Student::where('class_id', $smsCampaign->class_id)->get();
        foreach ($students as $student) {
            $smsLog = new SmsLog();
            $smsLog->sms_campaign_id = $smsCampaign->id;
            $smsLog->name = $student->first_name . ' ' . $student->last_name;
            $smsLog->msisdn = $student->phone1;
            $smsLog->message = $smsCampaign->message;
            $smsLog->characters = strlen($smsCampaign->message);
            $smsLog->length = ceil(strlen($smsCampaign->message) / 162);
            $smsLog->save();
        }
    }

    /**
     * Handle the SmsCampaign "updated" event.
     *
     * @param  \App\Models\SmsCampaign  $smsCampaign
     * @return void
     */
    public function updated(SmsCampaign $smsCampaign) {
        //
    }

    /**
     * Handle the SmsCampaign "deleted" event.
     *
     * @param  \App\Models\SmsCampaign  $smsCampaign
     * @return void
     */
    public function deleted(SmsCampaign $smsCampaign) {
        //
    }

    /**
     * Handle the SmsCampaign "restored" event.
     *
     * @param  \App\Models\SmsCampaign  $smsCampaign
     * @return void
     */
    public function restored(SmsCampaign $smsCampaign) {
        //
    }

    /**
     * Handle the SmsCampaign "force deleted" event.
     *
     * @param  \App\Models\SmsCampaign  $smsCampaign
     * @return void
     */
    public function forceDeleted(SmsCampaign $smsCampaign) {
        //
    }
}
