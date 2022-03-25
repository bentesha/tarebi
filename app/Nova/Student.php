<?php

namespace App\Nova;

use App\Nova\Actions\EnrollStudents;
use App\Nova\Actions\TerminateStudents;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Nikans\TextLinked\TextLinked;

class Student extends Resource {

    public static $group = 'Enrollment';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\Student::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'first_name';

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
                ->hide(),

            TextLinked::make(__('Number'), 'number')
                ->sortable()
                ->link($this)
                ->rules(['required', 'max:255'])
                ->creationRules('unique:students,number')
                ->updateRules('unique:students,number,{{resourceId}}'),

            BelongsTo::make('Admission', 'admission', Admission::class)
                ->display(function ($admission) {
                    return $admission->name . ' - Batch #: ' . $admission->batch;
                })->sortable(),

            BelongsTo::make(__('Program'), 'program', Program::class)
                ->display(function ($program) {
                    return $program->name . ' - ' . $program->number;
                })->sortable(),

            Text::make(__('Jina la Kwanza'), 'first_name')
                ->sortable()
                ->hideFromIndex()
                ->rules(['required', 'max:100']),

            Text::make(__('Jina la Kati'), 'middle_name')
                ->hideFromIndex(),

            Text::make(__('Jina la Mwisho'), 'last_name')
                ->sortable()
                ->hideFromIndex()
                ->rules(['required', 'max:100']),

            Text::make(__('Name'), function () {
                return $this->first_name . ' ' . $this->last_name;
            })->sortable()
                ->hideFromDetail()
                ->hideWhenCreating()
                ->hideWhenUpdating(),


            Select::make(__('Jinsia'), 'gender')
                ->options([
                    'Mwanaume' => 'Mwanaume',
                    'Mwanamke' => 'Mwanamke'
                ])->rules('required')
                ->hideFromIndex(),

            Date::make(__('Tarehe ya Kuzaliwa'), 'date_of_birth')
                ->rules('required')
                ->hideFromIndex(),

            Select::make(__('Hali ya Ndoa'), 'marital_status')
                ->options([
                    'Sijaoa/Olewa' => 'Sijaoa/Olewa',
                    'Nimeoa/Olewa' => 'Nimeoa/Olewa',
                    'Mtalaka/Mtaliki' => 'Mtalaka/Mtaliki',
                    'Mjane/Mgane' => 'Mjane/Mgane'
                ])
                ->rules('required')
                ->hideFromIndex(),

            Select::make(__('Aina ya Kitambulisho'), 'id_type')
                ->options([
                    'NIDA' => 'NIDA',
                    'Leseni ya Udereva' => 'Leseni ya Udereva',
                    'Mpiga Kura' => 'Mpiga Kura',
                    'Pasipoti' => 'Pasipoti'
                ])
                ->rules('required')
                ->hideFromIndex(),

            Text::make(__('Namba ya Kitambulisho'), 'id_number')
                ->hideFromIndex(),

            Text::make(__('Mkoa'), 'region')
                ->hideFromIndex(),

            Text::make(__('Wilaya'), 'district')
                ->hideFromIndex(),

            Text::make(__('Kata'), 'ward')
                ->hideFromIndex(),

            Text::make(__('Kijiji/Mtaa'), 'village_street')
                ->hideFromIndex(),

            Text::make(__('Simu 1'), 'phone1')
                ->hideFromIndex(),

            Text::make(__('Simu 2'), 'phone2')
                ->hideFromIndex(),

            Text::make(__('Barua Pepe 1'), 'email1')
                ->hideFromIndex(),

            Text::make(__('Barua Pepe 2'), 'email2')
                ->hideFromIndex(),

            Badge::make(__('Status'), 'status')
                ->map([
                    'Selected' => 'warning',
                    'Enrolled' => 'success',
                    'Terminated' => 'danger'
                ])
                ->hideWhenCreating()
                ->hideWhenUpdating(),

            Text::make(__('Terminated On'), function () {
                if ($this->terminated_on != null) {
                    return Carbon::createFromFormat('Y-m-d H:i:s', $this->terminated_on)->format('jS F, Y g:i A');
                }
            })->onlyOnDetail(),

            BelongsTo::make(__('Created By'), 'user', User::class)
                ->display(function ($user) {
                    return $user->name;
                })->onlyOnDetail(),

            Text::make(__('Created Date'), function () {
                return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('jS F, Y');
            })->onlyOnDetail()
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
            (new TerminateStudents())
                ->confirmText('You are about to terminate this student from enrollment')
                ->confirmButtonText('Yes, Terminate'),
            (new EnrollStudents())
                ->confirmText('You are about to make enrollment to selected student(s)')
                ->confirmButtonText('Yes, Enroll')
        ];
    }

    public static function authorizedToCreate(Request $request) {
        return false;
    }

    public function authorizedToDelete(Request $request) {
        return false;
    }
}
