<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Laravel\Nova\Http\Requests\NovaRequest;

class ApplicationComment extends Resource {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ApplicationComment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $displayInNavigation = false;

    public static function label() {
        return __('Comments');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request) {
        return [
            ID::make(__('ID'), 'id')
                ->hideFromIndex()
                ->hideFromDetail(),

            BelongsTo::make('Admission Application', 'application', AdmissionApplication::class)
                ->display(function ($application) {
                    return $application->first_name . ' ' . $application->last_name;
                })
                ->sortable(),

            BelongsTo::make('Posted By', 'user', User::class)
                ->display(function ($user) {
                    return $user->first_name . ' ' . $user->last_name;
                })
                ->sortable(),

            Textarea::make(__('Comment'), 'comment')
                ->sortable(),

            Text::make(__('Stage'), 'stage')
                ->sortable(),
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

    public function authorizedToUpdate(Request $request) {
        return false;
    }

    public function authorizeToDelete(Request $request) {
        return false;
    }
}
