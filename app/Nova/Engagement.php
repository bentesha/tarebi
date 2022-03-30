<?php

namespace App\Nova;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class Engagement extends Resource {

    public static $group = 'Enrollment';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Engagement::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
    ];

    public static function label() {
        return __('Engagements');
    }

    /**
     * Get the fields displayed by the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function fields(Request $request) {
        return [
            ID::make(__('ID'), 'id')->hide(),

            Text::make(__('Name'), 'name')
                ->rules('required'),

            Select::make(__('Type'), 'type')
                ->options([
                    'Training' => 'Training',
                    'Study Tour' => 'Study Tour',
                    'Coaching' => 'Coaching'
                ])->rules('required'),

            Date::make(__('Start Date'), 'start_date')
                ->onlyOnForms()
                ->rules('required'),

            Text::make(__('Start Date'), function () {
                return Carbon::parse($this->start_date)->format('jS F, Y');
            })->hideWhenCreating()
                ->hideWhenUpdating(),

            Date::make(__('End Date'), 'end_date')
                ->onlyOnForms()
                ->rules('required'),

            Text::make(__('End Date'), function () {
                return Carbon::parse($this->start_date)->format('jS F, Y');
            })->hideWhenCreating()
                ->hideWhenUpdating(),

            Textarea::make(__('Description'), 'description'),

            BelongsTo::make(__('Facilitator'), 'user', User::class)
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
