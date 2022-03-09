<?php

namespace App\Nova\Actions;

use App\Models\AdmissionApplication;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class ApproveByAdmission extends Action {
    use InteractsWithQueue, Queueable;

    public $name = 'Approve Applications';

    /**
     * Perform the action on the given applications.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $applications
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        foreach ($models as $model) {
            if ($model->locked == '0') {
                $applications = AdmissionApplication::where(['admission_id' => $model->id, 'locked' => '0'])->get();
                foreach ($applications as $application) {
                    $student = new Student();
                    $student->admission_id = $application->admission_id;
                    $student->admission_application_id = $application->id;
                    $student->program_id = $model->program_id;
                    $student->number = 'ST-' . date('Y') . '-' . $application->id;
                    $student->first_name = $application->first_name;
                    $student->middle_name = $application->middle_name;
                    $student->last_name = $application->last_name;
                    $student->gender = $application->gender;
                    $student->date_of_birth = $application->date_of_birth;
                    $student->region = $application->region;
                    $student->district = $application->district;
                    $student->ward = $application->ward;
                    $student->village_street = $application->village_street;
                    $student->id_type = $application->id_type;
                    $student->id_number = $application->id_number;
                    $student->marital_status = $application->marital_status;
                    $student->education = $application->education;
                    $student->education_other = $application->education_other;
                    $student->phone1 = $application->phone1;
                    $student->phone2 = $application->phone2;
                    $student->email1 = $application->email1;
                    $student->email2 = $application->email2;
                    if ($student->save()) {
                        $application->locked = '1';
                        $application->save();
                    }
                }
                $model->locked = '1';
                $model->save();
            }
        }
        return Action::message('Admission applications approved successfully');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields() {
        return [];
    }
}
