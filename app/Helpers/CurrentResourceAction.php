<?php

namespace App\Helpers;

class CurrentResourceAction {

    public static function isIndex($request) {
        return $request instanceof \Laravel\Nova\Http\Requests\ResourceIndexRequest;
    }
    public static function isDetail($request) {
        return $request instanceof \Laravel\Nova\Http\Requests\ResourceDetailRequest;
    }
    public static function isCreate($request) {
        return $request instanceof \Laravel\Nova\Http\Requests\NovaRequest &&
            $request->editMode === 'create';
    }
    public static function isUpdate($request) {
        return $request instanceof \Laravel\Nova\Http\Requests\NovaRequest &&
            $request->editMode === 'update';
    }
}
