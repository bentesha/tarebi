<?php

namespace App\Nova\Actions;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class TerminateStudents extends Action {
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        if ($models->contains('status', 'Terminated')) {
            return Action::danger('One or more selected student was already terminated');
        }

        foreach ($models as $model) {
            if ($model->status != 'Terminated') {
                $model->status = 'Terminated';
                $model->terminated_on = Carbon::now();
                $model->save();
            }
        }
        return Action::message('Student has been terminated from program');
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
