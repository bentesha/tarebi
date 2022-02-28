<?php

namespace App\Nova;

use App\Nova\Actions\AssessApplication;
use App\Nova\Actions\CommentApplication;
use App\Nova\Actions\RejectApplication;
use App\Nova\Actions\SelectApplication;
use Illuminate\Http\Request;
use Laravel\Nova\Fields\ID;
use Laravel\Nova\Fields\Text;
use Laravel\Nova\Fields\BelongsTo;
use Laravel\Nova\Fields\Date;
use Laravel\Nova\Fields\HasMany;
use Laravel\Nova\Fields\HasOne;
use Laravel\Nova\Fields\Number;
use Laravel\Nova\Fields\Select;
use Illuminate\Support\Carbon;
use Eminiarts\Tabs\Tabs;
use Eminiarts\Tabs\Tab;
use Eminiarts\Tabs\TabsOnEdit;
use Laravel\Nova\Panel;

class AdmissionApplication extends Resource {

    use TabsOnEdit;

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
        return __('New Application');
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
            Tabs::make('Application', [
                Tab::make('Application', [
                    ID::make(__('ID'), 'id')
                        ->hideFromIndex()
                        ->hideFromDetail(),

                    BelongsTo::make('Admission', 'admission', Admission::class)
                        ->display(function ($admission) {
                            return $admission->title . ' - Batch #: ' . $admission->batch;
                        })
                        ->searchable()
                        ->sortable(),

                    Text::make(__('Status'), 'status')
                        ->sortable()
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),
                ]),

                Tab::make('Personal Information', [
                    Text::make(__('Jina la kwanza'), 'first_name')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['required', 'max:100']),

                    Text::make(__('Jina la kati'), 'middle_name')
                        ->hideFromIndex(),

                    Text::make(__('Jina la mwisho'), 'last_name')
                        ->sortable()
                        ->hideFromIndex()
                        ->rules(['required', 'max:100']),

                    Text::make(__('Name'), function () {
                        return $this->first_name . ' ' . $this->last_name;
                    })->sortable()
                        ->hideFromDetail()
                        ->hideWhenCreating()
                        ->hideWhenUpdating(),


                    Select::make(__('Jinsia'), 'gender')
                        ->options([
                            'Mwanaume' => 'Mwanaume',
                            'Mwanamke' => 'Mwanamke'
                        ])->rules('required')
                        ->hideFromIndex(),

                    Date::make(__('Tarehe ya kuzaliwa'), 'date_of_birth')
                        ->rules('required')
                        ->hideFromIndex(),

                    Select::make(__('Hali ya ndoa'), 'marital_status')
                        ->options([
                            'Sijaoa/olewa' => 'Sijaoa/olewa',
                            'Nimeoa/olewa' => 'Nimeoa/olewa',
                            'Mtalaka/Mtaliki' => 'Mtalaka/Mtaliki',
                            'Mjane/Mgane' => 'Mjane/Mgane'
                        ])
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Aina ya kitambulisho'), 'id_type')
                        ->hideFromIndex(),

                    Text::make(__('Namba ya kitambulisho'), 'id_number')
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
                ]),

                Tab::make('Education', [
                    Select::make(__('Kiwango cha juu cha elimu'), 'education')
                        ->options([
                            'Sina' => 'Sina',
                            'Mhitimu elimu ya msingi' => 'Mhitimu wa elimu ya msingi',
                            'Mhitimu elimu ya sekondari' => 'Mhitimu elimu ya sekondari',
                            'Mafunzo ya ufundi' => 'Mafundi ya ufundi',
                            'Chuo cha kati/kikuu' => 'Chuo cha kati/kikuu',
                            'Elimu nyingine ya juu' => 'Elimu nyingine ya juu'
                        ])
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Elimu nyingine ya juu'), 'education_other')
                        ->hideFromIndex(),
                ]),

                Tab::make('Questionnaire', [
                    Select::make(__('Je, ungependa kupokea au kupata taarifa za mradi wa TAREBI kwa njia ipi kati ya zifuatazo?'), 'communication_subscription_method')
                        ->options([
                            'Simu' => 'Simu',
                            'Barua pepe' => 'Barua pepe',
                            'Mitandao ya kijamii' => 'Mitandao ya kijamii',
                            'Nyingine' => 'Nyingine'
                        ])
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make('Njia nyingine ambayo ungependa kupokea taarifa za mradi wa TAREBI', 'communication_subscription_method_other')
                        ->hideFromIndex(),

                    Select::make(__('Umewahi sajiliwa Kwenye huduma nyingine zinazotolewa na mradi wa TAREBI?'), 'previous_subscription_tarebi_services')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Select::make(__('Je, una watu wanaokutegemea?'), 'have_dependants')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Ni watu wangapi wanao kutegemea?'), 'number_of_dependants')
                        ->hideFromIndex(),

                    Select::make(__('Je, una ulemavu wowote?'), 'physical_disability')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Ainisha aina ya ulemavu ulionao'), 'physical_disability_type')
                        ->hideFromIndex(),

                    Number::make(__('Wastani wa kipato kwa mwezi katika biashara'), 'business_average_income')
                        ->hideFromIndex(),

                    Text::make(__('Shughuli nyingine za mapato'), 'other_income_activities')
                        ->hideFromIndex(),

                    Number::make(__('Wastani wa mapato katika shughuli nyingine'), 'other_income_activities_income')
                        ->hideFromIndex(),

                    Select::make(__('Je, umeajiriwa?'), 'employed')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Kama umeajiriwa taja mwajiri wako'), 'employer_name')
                        ->hideFromIndex(),

                    Select::make(__('Je, Unamiliki rasilimali mtaji?'), 'have_capital_asset')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Taja thamani ya rasilimali unazo miliki'), 'capital_asset_value')
                        ->hideFromIndex(),

                    Select::make(__('Je, unaweka akiba yoyote kwa sasa?'), 'have_savings')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Ipi ni thamani ya AKIBA YAKO YOTE'), 'savings_amount')
                        ->hideFromIndex(),

                    Select::make(__('Wapi unahifadhi akiba yako?'), 'savings_method')
                        ->options([
                            'Benki' => 'Benki',
                            'Vikundi vya Kuweka na kukopa vijijini (VSLA)' => 'Vikundi vya Kuweka na kukopa vijijini (VSLA)',
                            'Kibubu' => 'Kibubu',
                            'Pesa kwa njia ya Simu (M-pesa, Tigo-Pesa, Airtel Money n.k)' => 'Pesa kwa njia ya Simu (M-pesa, Tigo-Pesa, Airtel Money n.k)',
                            'SACCOS' => 'SACCOS',
                            'Familia' => 'Familia',
                            'Nyingine' => 'Nyingine'
                        ])
                        ->hideFromIndex(),

                    Text::make(__('Njia nyingine unayotumia kuhifadhi akiba yako'), 'savings_method_other')
                        ->hideFromIndex(),

                    Select::make(__('Je, una mkopo wowote kwa sasa?'), 'have_loan')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Ipi ni thamani ya MIKOPO YAKO YOTE'), 'total_loan_amount')
                        ->hideFromIndex(),

                    Select::make(__('Wapi unapopata mkopo wako?'), 'loan_source')
                        ->options([
                            'Benki' => 'Benki',
                            'Vikundi vya Kuweka na kukopa vijijini (VSLA)' => 'Vikundi vya Kuweka na kukopa vijijini (VSLA)',
                            'SACCOS' => 'SACCOS',
                            'Familia' => 'Familia',
                            'Nyingine' => 'Nyingine'
                        ])
                        ->hideFromIndex(),

                    Text::make(__('Kwingineko unakopata mkopo'), 'loan_source_other')
                        ->hideFromIndex(),

                    Select::make(__('Je, wewe ni mwanachama wa kikundi chochote (kikundi cha biashara au Kuweka na kukopa)?'), 'have_group')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Ainisha taarifa za kikundi chako (Aina ya Kikundi, biashara au kuweka na kukopa)'), 'group_details')
                        ->hideFromIndex(),

                    Select::make(__('Je, Kwa sasa unajishughulisha na biashara yeyote?'), 'doing_business')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Ainisha aina ya biashara unayofanya.'), 'business_type')
                        ->hideFromIndex(),

                    Select::make(__('Je, biashara hiyo ni yako?'), 'is_business_yours')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Select::make(__('Je, Biashara yako Imesajiliwa?'), 'is_business_registered')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Select::make(__('Imesajiliwa kwa njia gani? (Jina la usajili wa biashara)- Chagua zote zinazo kuhusu.'), 'business_registration_type')
                        ->options([
                            'Usajili wa Jina la Biashara (Brella)' => 'Usajili wa Jina la Biashara (Brella)',
                            'Leseni' => 'Leseni',
                            'Number ya Utambulisho wa Mlipa kodi (TIN)' => 'Number ya Utambulisho wa Mlipa kodi (TIN)',
                            'Kikundi Kilicho Sajiliwa na Serikali za Mtaa' => 'Kikundi Kilicho Sajiliwa na Serikali za Mtaa',
                            'Imethibitishwa na TBS/TFDA' => 'Imethibitishwa na TBS/TFDA',
                            'Nyingine' => 'Nyingine'
                        ])->hideFromIndex(),

                    Text::make(__('Aina nyingine ya usajili ya biashara yako'), 'business_registration_type_other')
                        ->hideFromIndex(),

                    Select::make(__('Je, Upo kwenye Mchakato wa Usajili?'), 'business_under_registration_process')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Number::make(__('Ni watu wangapi umewaajiri kwenye Biashara yako?'), 'business_employees_count')
                        ->hideFromIndex(),

                    Select::make(__('Umewahi kupata mafunzo ya biashara kupitia kiatamizi?'), 'trained_business_through_incubation')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Select::make(__('Ulipokea Mafunzo hayo chini ya  kiatamizi cha TAREBI?'), 'trained_by_tarebi_incubation')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Taja Mafunzo Mengine uliyopokea kutoka kwenye taasisi zingine'), 'other_training_from_other_institutes')
                        ->hideFromIndex(),

                    Select::make(__('Ungependa kupata mafunzo gani katika kiatamizi cha TAREBI'), 'preferred_training_from_tarebi')
                        ->options([
                            'Kuandaa mpango wa biashara' => 'Kuandaa mpango wa biashara',
                            'Huduma kwa wateja na Kutafuta masoko' => 'Huduma kwa wateja na Kutafuta masoko',
                            'Kuweka kumbukumbu ya mapato na matumizi' => 'Kuweka kumbukumbu ya mapato na matumizi',
                            'Ujuzi wa ufundi' => 'Ujuzi wa ufundi'
                        ])
                        ->rules('required')
                        ->hideFromIndex(),

                    Text::make(__('Je kuna mafunzo yoyote ambayo ungependa kutapa katika kiatamizi cha TAREBI? Yataje'), 'preferred_training_from_tarebi_other')
                        ->hideFromIndex(),

                    Select::make(__('Je unamiliki na kutumia simu janja?'), 'have_smartphone')
                        ->options($this->yesno())
                        ->rules('required')
                        ->hideFromIndex(),
                ]),

                Tab::make('Screening Results', [
                    new Panel('Screening Results', [
                        HasOne::make(__('Screening Results'), 'assessment', Assessment::class)
                            ->onlyOnDetail(),
                    ])
                ]),

            ]),

            HasMany::make('Comments', 'comments', ApplicationComment::class)
                ->onlyOnDetail()
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
            (new AssessApplication())
                ->confirmButtonText('Submit Assessment'),
            (new SelectApplication())
                ->confirmText('You are about to select this application')
                ->confirmButtonText('Yes, Select'),
            (new RejectApplication())
                ->confirmText('You are going to reject this application')
                ->confirmButtonText('Yes, Reject'),
            (new CommentApplication())
                ->confirmButtonText('Post Your Comment')
        ];
    }

    public function authorizedToDelete(Request $request) {
        return false;
    }

    /*
    public function authorizedToUpdate(Request $request) {
        if ($this->status == 'PENDING') {
            return true;
        } else {
            return false;
        }
    }
    */

    private function yesno() {
        return ['Ndiyo' => 'Ndiyo', 'Hapana' => 'Hapana'];
    }
}
