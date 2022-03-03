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
use Illuminate\Support\Carbon;
use Laravel\Nova\Http\Requests\NovaRequest;
use Nikans\TextLinked\TextLinked;

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
    public static $title = 'name';

    public static function label() {
        return __('Campaigns');
    }

    public static function createButtonLabel() {
        return __('New Campaign');
    }

    public static function updateButtonLabel() {
        return __('Save');
    }

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
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

            TextLinked::make(__('Name'), 'name')
                ->link($this)
                ->sortable()
                ->rules(['required', 'max:255']),

            Trix::make('Description')
                ->sortable()
                ->rules(['required', 'min:100']),

            BelongsTo::make('Admission', 'admission', Admission::class)
                ->display(function ($admission) {
                    return $admission->name;
                })
                ->searchable(),

            BelongsTo::make('Designated To', 'staff', User::class)
                ->sortable()
                ->searchable()
                ->rules('required'),

            Text::make(__('Type'), 'campaign_type')
                ->hideFromIndex()
                ->rules(['required', 'max:255']),

            Text::make('Institution')
                ->sortable()
                ->hideFromIndex(),

            Text::make('Location')
                ->sortable()
                ->hideFromIndex(),

            Text::make(__('Date'), function () {
                return Carbon::createFromFormat('Y-m-d H:i:s', $this->campaign_date)->format('jS F, Y');
            })->hideWhenCreating()
                ->hideWhenUpdating(),

            Date::make(__('Date'), 'campaign_date')
                ->hideFromIndex()
                ->hideFromDetail()
                ->rules('required'),

            Number::make(__('Reach'), 'potential_students_reached')
                ->hideFromIndex(),

            Number::make('Potential', 'potential_applicants')
                ->hideFromIndex(),

            BelongsTo::make('Created By', 'user', User::class)
                ->sortable()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Text::make(__('Created On'), function () {
                return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('jS F, Y');
            })->hideWhenCreating()
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
