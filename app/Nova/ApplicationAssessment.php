<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;

class ApplicationAssessment extends Resource {

    public static $group = 'Onboarding';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ApplicationAssessment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function label() {
        return __('Assessments');
    }

    public static function createButtonLabel() {
        return __('Create Assessment');
    }

    public static function updateButtonLabel() {
        return __('Save');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request) {
        return [
            ID::make(__('ID'), 'id')
                ->hide(),

            BelongsTo::make('Application', 'application', AdmissionApplication::class)
                ->display(function ($obj) {
                    return $obj->first_name . ' ' . $obj->last_name;
                })->sortable(),

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
                ->sortable(),

            Number::make(__('Screening Score'), 'screening_score')
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request) {
        return [];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request) {
        return [];
    }

    /**
     * Get the lenses available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function lenses(Request $request) {
        return [];
    }

    /**
     * Get the actions available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function actions(Request $request) {
        return [];
    }

    public static function authorizedToCreate(Request $request) {
        return false;
    }

    public function authorizeToDelete(Request $request) {
        return false;
    }
}
