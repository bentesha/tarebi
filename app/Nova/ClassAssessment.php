<?php

namespace App\Nova;

use App\Nova\Actions\AssessStudent;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Nikans\TextLinked\TextLinked;

class ClassAssessment extends Resource {

    public static $group = 'Enrollment';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ClassAssessment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'type';

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

            TextLinked::make(__('Date'), function () {
                return Carbon::parse($this->date)->format('jS F, Y');
            })->link($this)
                ->hideWhenCreating()
                ->hideWhenUpdating()
                ->sortable(),

            Date::make(__('Date'), 'date')
                ->rules('required')
                ->onlyOnForms(),

            BelongsTo::make(__('Class'), 'enrollmentClass', EnrollmentClass::class)
                ->display(function ($obj) {
                    return $obj->name . ' # ' . $obj->number;
                }),

            Select::make(__('Type'), 'type')
                ->options([
                    'Pre-Incubation' => 'Pre-Incubation',
                    'Incubation' => 'Incubation',
                    'Post-Incubation' => 'Post-Incubation'
                ])->rules('required'),

            BelongsTo::make(__('Created By'), 'user', User::class)
                ->display(function ($obj) {
                    return $obj->first_name . ' ' . $obj->last_name;
                })->hideWhenCreating()
                ->hideWhenUpdating(),

            HasMany::make(__('Assessments'), 'assessments', StudentAssessment::class)
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

    public function authorizedToDelete(Request $request) {
        return false;
    }
}
