<?php

namespace App\Nova\Actions;

use App\Models\Assessment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class AssessApplication extends Action {
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
            $assessment = null;
            if ($model->status == 'Pending') {
                $assessment = new Assessment();
            } else {
                $assessment = Assessment::where('admission_application_id', $model->id)->first();
            }
            $average_score = ($fields->education + $fields->business_experience) / 2;
            $assessment->admission_application_id = $model->id;
            $assessment->education = $fields->education;
            $assessment->business_experience = $fields->business_experience;
            $assessment->screening_score = $average_score;
            $assessment->save();

            $model->status = 'Screened';
            $model->save();
        }
        return Action::message('Application was successfully screened');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields() {
        return [
            Number::make(__('Education'), 'education')
                ->rules('required'),
            Number::make(__('Business Experience'), 'business_experience')
                ->rules('required')
        ];
    }
}
