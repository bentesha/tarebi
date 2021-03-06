<?php

namespace App\Nova\Actions;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;

class RejectApplication extends Action {
    use InteractsWithQueue, Queueable;

    public $name = 'Reject';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        foreach ($models as $model) {
            if ($model->status == 'Pending') {
                return Action::danger('Operation failed! Screening must be completed first');
            }
            $model->status = 'Rejected';
            $model->save();
        }
        return Action::message('This application has been rejected');
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
