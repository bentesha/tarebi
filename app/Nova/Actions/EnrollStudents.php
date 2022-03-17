<?php

namespace App\Nova\Actions;

use App\Models\EnrollmentClass;
use App\Models\StudentClass;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;

class EnrollStudents extends Action {
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        if ($models->contains('status', 'Enrolled')) {
            return Action::danger('One or more selected student has already been enrolled');
        }

        if ($models->contains('status', 'Terminated')) {
            return Action::danger('One or more selected student was terminated');
        }

        foreach ($models as $model) {
            if ($model->status == 'Terminated' || $model->status == 'Enrolled') {
                continue;
            } else if ($model->status == 'Selected') {
                $model->status = 'Enrolled';
                $model->class_id = $fields->class;
                $model->save();

                $studentClass = new StudentClass();
                $studentClass->student_id = $model->id;
                $studentClass->class_id = $fields->class;
                $studentClass->joined_on = $fields->joined_on;
                $studentClass->end_date = $fields->end_date;
                $studentClass->save();
            }
        }
        return Action::message('Enrollment has completed successfully');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields() {
        $options = EnrollmentClass::select(
            DB::raw("CONCAT(name,' # ',number) AS name"),
            'id'
        )->where('Status', 'Open')
            ->pluck('name', 'id');
        return [
            Select::make(__('Class'), 'class')
                ->options($options)
                ->rules('required'),
            Date::make(__('Joined On'), 'joined_on')
                ->rules('required'),
            Date::make(__('End Date'), 'end_date')
                ->rules('required')
        ];
    }
}
