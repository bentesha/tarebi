<?php

namespace App\Nova;

use App\Nova\Actions\ApproveByAdmission;
use Carbon\Carbon;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\Tabs;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Trix;
use Nikans\TextLinked\TextLinked;

class Admission extends Resource {

    public static $group = 'Onboarding';

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
    public static $title = 'name';

    /**
     * The columns that should be searched.
     *
     * @var array
     */
    public static $search = [
        'id',
        'name',
        'description',
        'period',
        'batch',
        'opening_date',
        'closing_date',
        'created_by',
        'status'
    ];

    public static function createButtonLabel() {
        return __('Create Admission');
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


            Tabs::make('Admission Details', [
                Tab::make(
                    'Admission',
                    [
                        ID::make('id')
                            ->sortable()
                            ->hideFromIndex()
                            ->hideFromDetail(),

                        TextLinked::make(__('Number'), 'batch')
                            ->sortable()
                            ->link($this)
                            ->rules(['required', 'max:255'])
                            ->creationRules('unique:admissions,batch')
                            ->updateRules('unique:admissions,batch,{{resourceId}}'),

                        Text::make(__('Name'), 'name')
                            ->sortable()
                            ->rules(['required', 'max:255']),

                        BelongsTo::make('Program', 'program', Program::class)
                            ->rules('required'),

                        Number::make(__('Number of Applications'), function () {
                            return $this->applications->count();
                        }),

                        Trix::make('Description')
                            ->hideFromIndex()
                            ->rules(['required']),

                        Text::make('Period')
                            ->hideFromIndex()
                            ->sortable(),

                        Date::make('Opening Date')
                            ->sortable()
                            ->hideFromIndex()
                            ->rules(['required']),

                        Date::make('Closing Date')
                            ->sortable()
                            ->hideFromIndex()
                            ->rules(['required']),

                        BelongsTo::make('Created By', 'user', User::class)
                            ->sortable()
                            ->hideFromIndex()
                            ->hideWhenCreating()
                            ->hideWhenUpdating(),

                        Text::make(__('Date Created'), function () {
                            return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('jS F, Y g:i A');
                        })->onlyOnDetail(),

                        Select::make('Status')
                            ->options([
                                'Open' => 'Open',
                                'Closed' => 'Closed'
                            ])
                            ->rules('required')
                    ]
                ),
                Tab::make(
                    'Applications',
                    [
                        HasMany::make('Applications', 'applications', AdmissionApplication::class)
                            ->onlyOnDetail()
                    ]
                ),
                Tab::make('Campaigns', [
                    HasMany::make('Campaigns', 'campaigns', AdmissionCampaign::class)
                        ->onlyOnDetail()
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
            (new ApproveByAdmission())
                ->confirmText('You are about to approve all selected applications')
                ->confirmButtonText('Yes, Approve')
                ->onlyOnDetail()
                ->canSee(function () {
                    return $this->resource->applications->count() > 0;
                })
        ];
    }
}
