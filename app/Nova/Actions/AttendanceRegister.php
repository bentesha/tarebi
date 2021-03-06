<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Textarea;

class AttendanceRegister extends Action {
    use InteractsWithQueue, Queueable;

    public $name = 'Record Attendance';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        foreach ($models as $model) {
            $model->attendance = $fields->attendance;
            $model->remarks = $fields->remarks;
            $model->save();
        }
        return Action::message('Attendance registered successfully');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields() {
        return [
            Select::make(__('Status'), 'attendance')
                ->options([
                    'Present' => 'Present',
                    'Absent' => 'Absent',
                    'Other' => 'Other'
                ])->rules('required'),

            Textarea::make(__('Remarks'), 'remarks')
        ];
    }
}
