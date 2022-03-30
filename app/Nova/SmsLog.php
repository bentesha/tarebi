<?php

namespace App\Nova;

use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class SmsLog extends Resource {

    public static $group = 'Messaging';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\SmsLog::class;

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
        return __('Outbox');
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

            Text::make(__('Name'), 'name')
                ->sortable(),

            Text::make(__('Phone'), 'msisdn')
                ->sortable(),

            Textarea::make(__('Message'), 'message'),

            Number::make(__('Characters'), 'characters')
                ->sortable(),

            Number::make(__('Length'), 'length')
                ->sortable(),

            Badge::make(__('Status'), 'status')
                ->map([
                    'Sent' => 'success',
                    'Pending' => 'warning',
                    'Failed' => 'danger'
                ])->hideWhenCreating()
                ->hideWhenUpdating(),

            Text::make(__('Sent On'), function () {
                return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('jS F, Y g:i A');
            })
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
