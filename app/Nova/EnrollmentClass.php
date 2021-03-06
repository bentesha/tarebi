<?php

namespace App\Nova;

use App\Nova\Actions\CreateClassAssessment;
use App\Nova\Actions\SendSMS;
use App\Nova\Actions\StudentAttendance;
use Carbon\Carbon;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Nikans\TextLinked\TextLinked;

class EnrollmentClass extends Resource {

    public static $group = 'Enrollment';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\EnrollmentClass::class;

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
        'id', 'name', 'number'
    ];

    public static function label() {
        return __('Classes');
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

            Tabs::make(__('Class Details'), [
                Tab::make(
                    __('Class'),
                    [
                        TextLinked::make(__('Number'), 'number')
                            ->sortable()
                            ->link($this)
                            ->rules(['required', 'max:255'])
                            ->creationRules('unique:classes,number')
                            ->updateRules('unique:classes,number,{{resourceId}}'),

                        Text::make(__('Name'), 'name')
                            ->rules('required'),

                        Select::make(__('Level'), 'level')
                            ->options([
                                'Pre-Incubation' => 'Pre-Incubation',
                                'Incubation' => 'Incubation',
                                'Post-Incubation' => 'Post-Incubation'
                            ])->rules('required'),

                        BelongsTo::make(__('Admission'), 'admission', Admission::class)
                            ->rules('required'),

                        Text::make(__('Program'), function () {
                            return $this->admission->program->name;
                        })->hideWhenCreating()
                            ->hideWhenUpdating(),

                        Date::make(__('Start Date'), 'start_date')
                            ->rules('required')
                            ->onlyOnForms(),

                        Text::make(__('Start Date'), function () {
                            if ($this->start_date != null) {
                                return Carbon::createFromFormat('Y-m-d H:i:s', $this->start_date)->format('jS F, Y');
                            } else {
                                return __('--');
                            }
                        })->hideWhenCreating()
                            ->hideWhenUpdating(),

                        Date::make(__('End Date'), 'end_date')
                            ->rules('required')
                            ->onlyOnForms(),

                        Text::make(__('End Date'), function () {
                            if ($this->end_date != null) {
                                return Carbon::createFromFormat('Y-m-d H:i:s', $this->end_date)->format('jS F, Y');
                            } else {
                                return __('--');
                            }
                        })->hideWhenCreating()
                            ->hideWhenUpdating(),

                        Textarea::make(__('Description'), 'description')
                            ->hideFromIndex(),
                    ]
                ),
                Tab::make(
                    __('Students'),
                    [
                        HasMany::make(__('Class Students'), 'studentsClasses', StudentClass::class)
                    ]
                ),
                Tab::make(__('Assessments'), [
                    HasMany::make(__('Assessments'), 'assessments', ClassAssessment::class)
                ])
            ])->withToolbar()
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
            (new StudentAttendance())
                ->confirmText('You are about to create attendance for this class')
                ->confirmButtonText('Yes, Create Attendance')
                ->onlyOnDetail(),
            (new SendSMS())
                ->confirmText('You are about to send messages to this/these class(es)')
                ->confirmButtonText('Yes, Send Message(s)'),
            (new CreateClassAssessment())
                ->confirmButtonText('Save')
        ];
    }
}
