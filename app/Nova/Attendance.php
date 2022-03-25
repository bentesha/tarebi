<?php

namespace App\Nova;

use App\Nova\Actions\AttendanceRegister;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\BelongsToMany;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Nikans\TextLinked\TextLinked;

class Attendance extends Resource {

    public static $group = 'Enrollment';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Attendance::class;

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
        return __('Attendances');
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

            TextLinked::make(__('Name'), 'name')
                ->link($this)
                ->rules('required'),

            Date::make(__('Date'), 'date')
                ->rules('required')
                ->onlyOnForms(),

            Text::make(__('Date'), function () {
                if ($this->date != null) {
                    return Carbon::parse($this->date)->format('jS F, Y');
                } else {
                    return __('--');
                }
            })->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make(__('Class'), 'enrollmentClass', EnrollmentClass::class)
                ->display(function ($class) {
                    return $class->name . ' # ' . $class->number;
                })
                ->rules('required'),

            HasMany::make(__('Session Attendance'), 'studentsAttendances', StudentAttendance::class)
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
