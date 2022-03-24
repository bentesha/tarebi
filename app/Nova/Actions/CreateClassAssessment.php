<?php

namespace App\Nova\Actions;

use App\Models\ClassAssessment;
use App\Models\Student;
use App\Models\StudentAssessment;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;

class CreateClassAssessment extends Action {
    use InteractsWithQueue, Queueable;

    public $name = 'Assess';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        foreach ($models as $model) {
            $assessment = new ClassAssessment();
            $assessment->date = $fields->date;
            $assessment->class_id = $model->id;
            $assessment->type = $fields->type;

            if ($assessment->save()) {
                $students = Student::where('class_id', $model->id)->get();
                foreach ($students as $student) {
                    $studentAssessment = new StudentAssessment();
                    $studentAssessment->class_assessment_id = $assessment->id;
                    $studentAssessment->student_id = $student->id;
                    $studentAssessment->save();
                }
            }
        }
        return Action::message('Assessment created');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields() {
        return [
            Date::make(__('Date'), 'date')
                ->rules('required')
                ->onlyOnForms(),

            Select::make(__('Type'), 'type')
                ->options([
                    'Pre-Incubation' => 'Pre-Incubation',
                    'Incubation' => 'Incubation',
                    'Post-Incubation' => 'Post-Incubation'
                ])->rules('required')
        ];
    }
}
