<?php

use App\Nova\Admission;
use App\Nova\AdmissionApplication;
use App\Nova\ApplicationAssessment;
use App\Nova\Attendance;
use App\Nova\EnrollmentClass;
use Illuminate\Http\Request;
use Laravel\Nova\Nova;
use Laravel\Nova\Tool;

class ResourceManager extends Tool {

    public function boot() {
        Nova::provideToScript([
            'resources' => function (Request $request) {
                return Nova::resourceInformation($request);
            },
        ]);
    }

    public function renderNavigation() {
        $request = request();
        $groups = Nova::groups($request);

        $newNavigation = collect([
            'Onboarding' => collect([
                Admission::class,
                AdmissionApplication::class,
                ApplicationAssessment::class,
            ]),
            'Enrollment' => collect([
                Attendance::class,
                EnrollmentClass::class,
            ]),
        ]);

        return view('nova::resources.navigation', [
            'navigation' => $newNavigation,
            'groups' => $groups,
        ]);
    }
}
