<?php

namespace App\Nova\Actions;

use App\Models\StudentAssessment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\KeyValue;

class AssessStudent extends Action {
    use InteractsWithQueue, Queueable;

    public $name = 'Assess';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        foreach ($models as $model) {
            $model->assessment = $fields->assessment;
            $model->save();
        }
        return Action::message('Assessment performed successfully');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields() {
        return [
            KeyValue::make(__('Assessment'), 'assessment')
        ];
    }
}
