<?php

namespace App\Nova\Actions;

use App\Models\ApplicationComment;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class CommentApplication extends Action {
    use InteractsWithQueue, Queueable;

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        foreach ($models as $model) {
            $comment = new ApplicationComment();
            $comment->admission_application_id = $model->id;
            $comment->comment = $fields->comment;
            $comment->save();
        }
        return Action::message('Your comment was submitted successfully!');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields() {
        return [
            Textarea::make(__('Add your comment'), 'comment')
                ->rules('required')
        ];
    }
}
