<?php

namespace App\Nova;

use Illuminate\Http\Request;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Log;

class ApplicationComment extends Resource {
    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\ApplicationComment::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public static $displayInNavigation = false;

    public static function label() {
        return __('Comments');
    }

    public static function createButtonLabel() {
        return __('New Comment');
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

            BelongsTo::make(__('Posted By'), 'postedBy', User::class)
                ->display(function ($obj) {
                    return $obj->name;
                })->onlyOnIndex(),

            Textarea::make(__('Comment'), 'comment')
                ->rules('required')
                ->sortable(),

            Text::make(__('Comment'), function () {
                return $this->comment;
            })->onlyOnIndex(),

            Text::make(__('Posted On'), function () {
                return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('jS M, Y g:i A');
            })->onlyOnIndex()
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

    /*
    public static function authorizedToCreate(Request $request) {
        return false;
    }

    public function authorizedToUpdate(Request $request) {
        return false;
    }

    public function authorizeToDelete(Request $request) {
        return false;
    }
    */
}
