<?php

namespace App\Nova\Actions;

use App\Models\Assessment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Number;

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
            $assessment->admission_application_id = $model->id;
            $assessment->age_range = $fields->age_range;
            $assessment->business_idea = $fields->business_idea;
            $assessment->solar_related_business = $fields->solar_related_business;
            $assessment->knowledgeable_about_solar_installations = $fields->knowledgeable_about_solar_installations;
            $assessment->graduated_from_technical_training = $fields->graduated_from_technical_training;
            $assessment->business_experience = $fields->business_experience;
            $assessment->screening_score = collect($fields)->avg();
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
            Number::make(__('Age'), 'age_range')
                ->rules('required')
                ->sortable(),

            Number::make(__('Business Idea'), 'business_idea')
                ->rules('required')
                ->sortable(),

            Number::make(__('Solar Related Business'), 'solar_related_business')
                ->rules('required')
                ->sortable(),

            Number::make(__('Knowledgeable About Solar Installations'), 'knowledgeable_about_solar_installations')
                ->rules('required')
                ->sortable(),

            Number::make(__('Graduated From Technical Training'), 'graduated_from_technical_training')
                ->rules('required')
                ->sortable(),

            Number::make(__('Business Experience'), 'business_experience')
                ->rules('required')
                ->sortable()
        ];
    }
}
