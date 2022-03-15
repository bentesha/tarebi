<?php

namespace App\Nova\Actions;

use App\Models\EnrollmentClass;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\DB;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
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

        foreach ($models as $model) {
            $model->status = 'Enrolled';
            $model->class_id = $fields->class;
            $model->save();
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
                ->rules('required')
        ];
    }
}
