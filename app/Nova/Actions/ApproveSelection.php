<?php

namespace App\Nova\Actions;

use App\Models\Admission;
use App\Models\Student;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Log;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Illuminate\Support\Facades\DB;

class ApproveSelection extends Action {
    use InteractsWithQueue, Queueable;

    public $name = 'Approve';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        if ($models->contains('status', 'Pending') || $models->contains('status', 'Screened')) {
            return Action::danger('Approval denied, selection is not complete');
        }

        foreach ($models as $model) {
            $admission = Admission::where(['id' => $model->admission_id, 'locked' => '0'])->first();
            if ($admission != null && $model->status == 'Selected' && $model->locked == 0) {
                $student = new Student();
                $student->admission_id = $model->admission_id;
                $student->admission_application_id = $model->id;
                $student->program_id = $admission->program_id;
                $student->number = 'ST-' . date('Y') . '-' . $model->id;
                $student->first_name = $model->first_name;
                $student->middle_name = $model->middle_name;
                $student->last_name = $model->last_name;
                $student->gender = $model->gender;
                $student->date_of_birth = $model->date_of_birth;
                $student->region = $model->region;
                $student->district = $model->district;
                $student->ward = $model->ward;
                $student->village_street = $model->village_street;
                $student->id_type = $model->id_type;
                $student->id_number = $model->id_number;
                $student->marital_status = $model->marital_status;
                $student->education = $model->education;
                $student->education_other = $model->education_other;
                $student->phone1 = $model->phone1;
                $student->phone2 = $model->phone2;
                $student->email1 = $model->email1;
                $student->email2 = $model->email2;
                if ($student->save()) {
                    $model->locked = '1';
                    $model->save();

                    $admission->locked = '1';
                    $admission->save();
                    return Action::message('Selections approved');
                } else {
                    return Action::danger('An error has occured');
                }
            } else {
                return Action::danger('Nothing to process, admission is locked');
            }
        }
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
