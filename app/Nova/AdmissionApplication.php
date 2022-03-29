<?php

namespace App\Nova;

use App\Nova\Actions\AssessApplication;
use App\Nova\Actions\RejectApplication;
use App\Nova\Actions\SelectApplication;
use App\Nova\Filters\ApplicationsByAdmission;
use App\Nova\Filters\ApplicationStatus;
use App\Nova\Metrics\Applications;
use App\Nova\Metrics\ApplicationsStatus;
use App\Nova\Metrics\NewApplications;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\TabsOnEdit;
use KirschbaumDevelopment\NovaComments\Commenter;
use KirschbaumDevelopment\NovaComments\Nova\Comment;
use Laravel\Nova\Fields\Badge;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Panel;
use Nikans\TextLinked\TextLinked;
use OptimistDigital\MultiselectField\Multiselect;;

class AdmissionApplication extends Resource {

    use TabsOnEdit;

    public static $group = 'Onboarding';

    /**
     * The model the resource corresponds to.
     *
     * @var string
     */
    public static $model = \App\Models\AdmissionApplication::class;

    /**
     * The single value that should be used to represent the resource when being displayed.
     *
     * @var string
     */
    public static $title = 'id';

    public function title() {
        return $this->first_name . ' ' . $this->last_name;
    }

    public static function label() {
        return __('Applications');
    }

    public static function createButtonLabel() {
        return __('Create Application');
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
        'first_name',
        'middle_name',
        'last_name'
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

            Tabs::make('Application Details', [
                Tab::make('General', [
                    TextLinked::make(__('Number'), 'number')
                        ->sortable()
                        ->link($this)
                        ->rules(['required', 'max:255'])
                        ->creationRules('unique:programs,number')
                        ->updateRules('unique:programs,number,{{resourceId}}'),

                    Text::make(__('Name'), function () {
                        return $this->first_name . ' ' . $this->last_name;
                    })->sortable()
                        ->hideFromDetail()
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    BelongsTo::make('Admission', 'admission', Admission::class)
                        ->display(function ($admission) {
                            return $admission->name . ' - Batch #: ' . $admission->batch;
                        })->sortable(),

                    BelongsTo::make(__('Program'), 'admission', Admission::class)
                        ->display(function ($admission) {
                            return $admission->program->name;
                        })
                        ->onlyOnDetail(),

                    Text::make(__('Submitted Date'), function () {
                        if ($this->submitted_on != null) {
                            return Carbon::parse($this->submitted_on)->format('jS F, Y');
                        } else {
                            return __('--');
                        }
                    })->onlyOnDetail(),

                    Date::make(__('Submitted Date'), 'submitted_on')
                        ->onlyOnForms(),

                    Badge::make(__('Status'), 'status')
                        ->map([
                            'Pending' => 'warning',
                            'Screened' => 'info',
                            'Selected' => 'success',
                            'Rejected' => 'danger'
                        ])
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),

                    BelongsTo::make(__('Created By'), 'user', User::class)
                        ->display(function ($user) {
                            return $user->name;
                        })->onlyOnDetail(),

                    Text::make(__('Created Date'), function () {
                        if ($this->created_at != null) {
                            return Carbon::createFromFormat('Y-m-d H:i:s', $this->created_at)->format('jS F, Y');
                        } else {
                            return __('--');
                        }
                    })->onlyOnDetail()
                ]),

                Text::make(__('Score'), 'score')
                    ->hideWhenCreating()
                    ->hideWhenUpdating(),

                Tab::make('Personal Information', [
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
                ]),

                Tab::make('Address', [
                    Text::make(__('Mkoa'), 'region')
                        ->hideFromIndex(),

                    Text::make(__('Wilaya'), 'district')
                        ->hideFromIndex(),

                    Text::make(__('Kata'), 'ward')
                        ->hideFromIndex(),

                    Text::make(__('Kijiji/Mtaa'), 'village_street')
                        ->hideFromIndex(),
                ]),

                Tab::make('Contacts', [
                    Text::make(__('Simu 1'), 'phone1')
                        ->hideFromIndex(),

                    Text::make(__('Simu 2'), 'phone2')
                        ->hideFromIndex(),

                    Text::make(__('Barua Pepe 1'), 'email1')
                        ->hideFromIndex(),

                    Text::make(__('Barua Pepe 2'), 'email2')
                        ->hideFromIndex()
                ]),

                Tab::make('Education', [
                    Select::make(__('Kiwango cha Juu cha Elimu'), 'education')
                        ->options([
                            'Sina' => 'Sina',
                            'Mhitimu Elimu ya Msingi' => 'Mhitimu wa Elimu ya Msingi',
                            'Mhitimu Elimu ya Sekondari' => 'Mhitimu Elimu ya Sekondari',
                            'Mafunzo ya Ufundi' => 'Mafunzo ya Ufundi',
                            'Chuo cha Kati/Kikuu' => 'Chuo cha Kati/Kikuu',
                            'Elimu Nyingine ya Juu' => 'Elimu Nyingine ya Juu'
                        ])
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Elimu Nyingine ya Juu'), 'education_other')
                        ->hideFromIndex(),
                ]),

                Tab::make('Questionnaire', [
                    Select::make(__('Je, Ungependa Kupokea au Kupata Taarifa za Mradi wa TAREBI kwa Njia Ipi Kati ya Zifuatazo?'), 'communication_subscription_method')
                        ->options([
                            'Simu' => 'Simu',
                            'Barua Pepe' => 'Barua Pepe',
                            'Mitandao ya Kijamii' => 'Mitandao ya Kijamii',
                            'Nyingine' => 'Nyingine'
                        ])
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make('Njia Nyingine Ambayo Ungependa Kupokea Taarifa za Mradi wa TAREBI', 'communication_subscription_method_other')
                        ->hideFromIndex(),

                    Select::make(__('Umewahi Sajiliwa Kwenye Huduma Nyingine Zinazotolewa na Mradi wa TAREBI?'), 'previous_subscription_tarebi_services')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Select::make(__('Je, Una Watu Wanaokutegemea?'), 'have_dependants')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Ni Watu Wangapi Wanao Kutegemea?'), 'number_of_dependants')
                        ->hideFromIndex(),

                    Select::make(__('Je, Una Ulemavu Wowote?'), 'physical_disability')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Ainisha Aina ya Ulemavu Ulionao'), 'physical_disability_type')
                        ->hideFromIndex(),

                    Number::make(__('Wastani wa Kipato kwa Mwezi Katika Kiashara'), 'business_average_income')
                        ->hideFromIndex(),

                    Text::make(__('Shughuli Nyingine za Mapato'), 'other_income_activities')
                        ->hideFromIndex(),

                    Number::make(__('Wastani wa Mapato Katika Shughuli Nyingine'), 'other_income_activities_income')
                        ->hideFromIndex(),

                    Select::make(__('Je, Umeajiriwa?'), 'employed')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Kama Umeajiriwa Taja Mwajiri Wako'), 'employer_name')
                        ->hideFromIndex(),

                    Select::make(__('Je, Unamiliki Rasilimali Mtaji?'), 'have_capital_asset')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Taja Thamani ya Rasilimali Unazo Miliki'), 'capital_asset_value')
                        ->hideFromIndex(),

                    Select::make(__('Je, Unaweka Akiba Yoyote kwa Sasa?'), 'have_savings')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Ipi ni Thamani ya AKIBA YAKO YOTE'), 'savings_amount')
                        ->hideFromIndex(),

                    Select::make(__('Wapi Unahifadhi Akiba Yako?'), 'savings_method')
                        ->options([
                            'Benki' => 'Benki',
                            'Vikundi vya Kuweka na Kukopa Vijijini (VSLA)' => 'Vikundi vya Kuweka na Kukopa Vijijini (VSLA)',
                            'Kibubu' => 'Kibubu',
                            'Pesa kwa Njia ya Simu (M-pesa, Tigo-Pesa, Airtel Money n.k)' => 'Pesa kwa Njia ya Simu (M-pesa, Tigo-Pesa, Airtel Money n.k)',
                            'SACCOS' => 'SACCOS',
                            'Familia' => 'Familia',
                            'Nyingine' => 'Nyingine'
                        ])
                        ->hideFromIndex(),

                    Text::make(__('Njia Nyingine Unayotumia Kuhifadhi Akiba Yako'), 'savings_method_other')
                        ->hideFromIndex(),

                    Select::make(__('Je, Una Mkopo Wowote kwa Sasa?'), 'have_loan')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Ipi ni Thamani ya MIKOPO YAKO YOTE'), 'total_loan_amount')
                        ->hideFromIndex(),

                    Select::make(__('Wapi Unapopata Mkopo Wako?'), 'loan_source')
                        ->options([
                            'Benki' => 'Benki',
                            'Vikundi vya Kuweka na Kukopa Vijijini (VSLA)' => 'Vikundi vya Kuweka na Kukopa Vijijini (VSLA)',
                            'SACCOS' => 'SACCOS',
                            'Familia' => 'Familia',
                            'Nyingine' => 'Nyingine'
                        ])
                        ->hideFromIndex(),

                    Text::make(__('Kwingineko Unakopata Mkopo'), 'loan_source_other')
                        ->hideFromIndex(),

                    Select::make(__('Je, Wewe ni Mwanachama wa Kikundi Chochote (Kikundi cha Biashara au Kuweka na Kukopa)?'), 'have_group')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Ainisha Taarifa za Kikundi Chako (Aina ya Kikundi, Biashara au Kuweka na Kukopa)'), 'group_details')
                        ->hideFromIndex(),

                    Select::make(__('Je, Kwa Sasa Unajishughulisha na Biashara Yeyote?'), 'doing_business')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Ainisha Aina ya Biashara Unayofanya.'), 'business_type')
                        ->hideFromIndex(),

                    Select::make(__('Je, Biashara Hiyo ni Yako?'), 'is_business_yours')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Select::make(__('Je, Biashara Yako Imesajiliwa?'), 'is_business_registered')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Multiselect::make(__('Imesajiliwa kwa Njia Gani? (Jina la Usajili wa Biashara)- Chagua Zote Zinazo Kuhusu.'), 'business_registration_type')
                        ->options([
                            'Usajili wa Jina la Biashara (Brella)' => 'Usajili wa Jina la Biashara (Brella)',
                            'Leseni' => 'Leseni',
                            'Number ya Utambulisho wa Mlipa Kodi (TIN)' => 'Number ya Utambulisho wa Mlipa Kodi (TIN)',
                            'Kikundi Kilicho Sajiliwa na Serikali za Mtaa' => 'Kikundi Kilicho Sajiliwa na Serikali za Mtaa',
                            'Imethibitishwa na TBS/TFDA' => 'Imethibitishwa na TBS/TFDA',
                            'Nyingine' => 'Nyingine'
                        ])->hideFromIndex(),

                    Text::make(__('Aina Nyingine ya Usajili ya Biashara yako'), 'business_registration_type_other')
                        ->hideFromIndex(),

                    Select::make(__('Je, Upo Kwenye Mchakato wa Usajili?'), 'business_under_registration_process')
                        ->options($this->yesno())
                        ->hideFromIndex(),

                    Number::make(__('Ni Watu Wangapi Umewaajiri Kwenye Biashara Yako?'), 'business_employees_count')
                        ->hideFromIndex(),

                    Select::make(__('Umewahi Kupata Mafunzo ya Biashara Kupitia Kiatamizi?'), 'trained_business_through_incubation')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Select::make(__('Ulipokea Mafunzo Hayo Chini ya  Kiatamizi cha TAREBI?'), 'trained_by_tarebi_incubation')
                        ->options($this->yesno())
                        ->hideFromIndex(),

                    Text::make(__('Taja Mafunzo Mengine Uliyopokea Kutoka Kwenye Taasisi Zingine'), 'other_training_from_other_institutes')
                        ->hideFromIndex(),

                    Select::make(__('Ungependa Kupata Mafunzo Gani Katika Kiatamizi cha TAREBI'), 'preferred_training_from_tarebi')
                        ->options([
                            'Kuandaa Mpango wa Biashara' => 'Kuandaa Mpango wa Biashara',
                            'Huduma kwa Wateja na Kutafuta Masoko' => 'Huduma kwa Wateja na Kutafuta Masoko',
                            'Kuweka Kumbukumbu ya Mapato na Matumizi' => 'Kuweka Kumbukumbu ya Mapato na Matumizi',
                            'Ujuzi wa Ufundi' => 'Ujuzi wa Ufundi'
                        ])
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Je Kuna Mafunzo Yoyote Ambayo Ungependa Kutapa Katika Kiatamizi cha TAREBI? Yataje'), 'preferred_training_from_tarebi_other')
                        ->hideFromIndex(),

                    Select::make(__('Je Unamiliki na Kutumia Simu Janja?'), 'have_smartphone')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),
                ]),

                Tab::make('Screening Results', [
                    new Panel('Screening Results', [
                        HasOne::make(__('Screening Results'), 'assessment', ApplicationAssessment::class)
                            ->onlyOnDetail(),
                    ])
                ]),

            ])->withToolbar(),

            Commenter::make(),
            HasMany::make('Comments', 'comments', Comment::class)->hideFromDetail()->hideFromIndex()
        ];
    }

    /**
     * Get the cards available for the request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function cards(Request $request) {
        return [
            new NewApplications(),
            new ApplicationsStatus(),
            new Applications()
        ];
    }

    /**
     * Get the filters available for the resource.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function filters(Request $request) {
        return [
            new ApplicationStatus(),
            new ApplicationsByAdmission()
        ];
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
            (new AssessApplication())
                ->confirmButtonText('Submit Assessment')
                ->onlyOnDetail(),
            (new SelectApplication())
                ->confirmText('You are about to select this application')
                ->confirmButtonText('Yes, Select'),
            (new RejectApplication())
                ->confirmText('You are going to reject this application')
                ->confirmButtonText('Yes, Reject')
        ];
    }

    public function authorizedToDelete(Request $request) {
        return false;
    }

    public function authorizedToUpdate(Request $request) {
        if ($this->locked == '0') {
            return true;
        } elseif ($this->locked == '1') {
            return false;
        }
    }

    private function yesno() {
        return ['Ndiyo' => 'Ndiyo', 'Hapana' => 'Hapana'];
    }
}
