<?php

namespace App\Nova\Actions;

use App\Models\Attendance;
use App\Models\Engagement;
use App\Models\Student;
use App\Models\StudentAttendance as ModelsStudentAttendance;
use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Collection;
use Laravel\Nova\Actions\Action;
use Laravel\Nova\Fields\ActionFields;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\Select;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\Textarea;

class StudentAttendance extends Action {
    use InteractsWithQueue, Queueable;

    public $name = 'New Attendance';

    /**
     * Perform the action on the given models.
     *
     * @param  \Laravel\Nova\Fields\ActionFields  $fields
     * @param  \Illuminate\Support\Collection  $models
     * @return mixed
     */
    public function handle(ActionFields $fields, Collection $models) {
        if ($models->contains('date', Carbon::parse($fields->date)->format('Y-m-d'))) {
            return Action::danger('Attendance for specified date was already taken');
        }

        foreach ($models as $model) {
            $attendance = new Attendance();
            $attendance->engagement_id = $fields->engagement;
            $attendance->date = $fields->date;
            $attendance->class_id = $model->id;

            if ($attendance->save()) {
                $students = Student::where('class_id', $model->id)->get();
                foreach ($students as $student) {
                    $studentAttendance = new ModelsStudentAttendance();
                    $studentAttendance->student_id = $student->id;
                    $studentAttendance->attendance_id = $attendance->id;
                    $studentAttendance->save();
                }
            }
        }
        return Action::message('Attendance successfully created');
    }

    /**
     * Get the fields available on the action.
     *
     * @return array
     */
    public function fields() {
        return [
            Select::make(__('Engagement'), 'engagement')
                ->options(Engagement::pluck('name', 'id'))
                ->rules('required'),
            Date::make(__('Date'), 'date')
                ->rules('required'),
            Textarea::make(__('Description'), 'description')
        ];
    }
}
