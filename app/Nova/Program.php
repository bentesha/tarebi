<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Nikans\TextLinked\TextLinked;

class Program extends Resource {

    public static $group = 'Settings';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Program::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'name';

    public static function createButtonLabel() {
        return __('Create Program');
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
        'id', 'name', 'description'
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

            TextLinked::make(__('Number'), 'number')
                ->sortable()
                ->link($this)
                ->rules(['required', 'max:255'])
                ->creationRules('unique:programs,number')
                ->updateRules('unique:programs,number,{{resourceId}}'),

            Text::make(__('Name'), 'name')
                ->sortable()
                ->rules(['required', 'max:255'])
                ->creationRules('unique:programs,name')
                ->updateRules('unique:programs,name,{{resourceId}}'),

            Textarea::make(__('Description'), 'description')
                ->sortable()
                ->rules('required')
                ->rows(2)
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
