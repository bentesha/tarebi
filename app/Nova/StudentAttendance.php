<?php

namespace App\Nova;

use App\Nova\Actions\AttendanceRegister;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;

class StudentAttendance extends Resource {

    public static $group = 'Enrollment';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\StudentAttendance::class;

    public static $displayInNavigation = false;

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
        return __('Student Attendances');
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
                ->hideFromDetail()
                ->hideFromIndex()
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            BelongsTo::make(__('Name'), 'student', Student::class)
                ->display(function ($student) {
                    return $student->first_name . ' ' . $student->last_name;
                }),

            Badge::make(__('Attendance'), 'attendance')
                ->map([
                    'Present' => 'success',
                    'Absent' => 'danger',
                    'Other' => 'warning',
                    '' => 'info'
                ])->onlyOnIndex()
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
        return [
            (new AttendanceRegister())
                ->confirmButtonText('Save')
        ];
    }

    public static function authorizedToCreate(Request $request) {
        return false;
    }

    public function authorizeToUpdate(Request $request) {
        return false;
    }

    public function authorizeToDelete(Request $request) {
        return false;
    }
}
