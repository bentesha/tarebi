<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class AdmissionCampaign extends Resource {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\AdmissionCampaign::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'title';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'title',
        'description',
        'campaign_type',
        'institution',
        'location',
        'campaign_date',
        'status'
    ];

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request) {
        return [
            ID::make('id')->sortable()
                ->hideFromIndex()
                ->hideFromDetail(),

            Text::make('Title')
                ->sortable()
                ->rules(['required', 'max:255']),

            Trix::make('Description')
                ->sortable()
                ->rules(['required', 'min:100']),

            BelongsTo::make('Admission', 'admission', Admission::class)
                ->display(function ($admission) {
                    return $admission->title;
                })
                ->searchable(),

            BelongsTo::make('Staff', 'staff', User::class)
                ->sortable()
                ->searchable()
                ->rules('required'),

            Text::make('Campaign Type')
                ->sortable()
                ->rules(['required', 'max:255']),

            Text::make('Institution')
                ->sortable()
                ->hideFromIndex(),

            Text::make('Location')
                ->sortable()
                ->hideFromIndex(),

            Date::make('Campaign Date')
                ->sortable()
                ->rules('required'),

            Number::make('Potential Students Reached')
                ->sortable(),

            Number::make('Potential Applicants')
                ->sortable(),

            Text::make('Status')
                ->onlyOnIndex()
                ->onlyOnDetail(),

            BelongsTo::make('Created By', 'user', User::class)
                ->sortable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),
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
}
