<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Laravel\Nova\Http\Requests\NovaRequest;

class Admission extends Resource {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Admission::class;

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
        'period',
        'batch',
        'opening_date',
        'closing_date',
        'created_by',
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
            ID::make('id')
                ->sortable()
                ->hideFromIndex()
                ->hideFromDetail(),

            Text::make('Title')
                ->sortable()
                ->rules(['required', 'max:255']),

            Trix::make('Description')
                ->sortable()
                ->rules(['required']),

            Text::make('Period')
                ->sortable(),

            Text::make('Batch')
                ->sortable()
                ->rules(['required', 'max:255'])
                ->creationRules('unique:admissions,batch')
                ->updateRules('unique:admissions,batch,{{resourceId}}'),

            Date::make('Opening Date')
                ->sortable()
                ->rules(['required']),

            Date::make('Closing Date')
                ->sortable()
                ->rules(['required']),

            BelongsTo::make('Created By', 'user', User::class)
                ->sortable()
                ->searchable()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Select::make('Status')
                ->options([
                    'open' => 'Open',
                    'closed' => 'Closed'
                ])
                ->rules('required')
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
