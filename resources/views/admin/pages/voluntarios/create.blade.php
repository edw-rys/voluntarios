@extends('admin.templates.template')
@section('styles_cdn')
    <link rel="stylesheet" href="http://www.bufa.es/wp-content/themes/bufa/css/google-maps-latitud-longitud.css?ver=4.7.3"
        type="text/css" media="all" />
@endsection
@section('content')
    <form class="steps" accept-charset="UTF-8" onsubmit="return crearVoluntario()">
        <ul id="progressbar">
            <li class="active">{{ trans('global.voluntarios.create.maps') }}</li>
            <li>Aquisition</li>
            <li>Cultivation</li>
            <li>Cultivation2</li>
            <li>Retention</li>
        </ul>

        {{-- Mapas para selecciona la ubicación --}}
        <fieldset>
            <h2 class="fs-title">Ubicación</h2>
            <h3 class="fs-subtitle">Busque su ubicación y de clic en siguiente.</h3>
            @include('admin.pages.voluntarios.components.maps')
            <!-- End Total Number of Constituents in Your Database Field -->
            <input type="button" data-page="1" name="next" class="next action-button" value="Next" />
        </fieldset>
        {{-- Cédula / pasaporte - Tipo de práctica --}}
        <fieldset>
            @include('admin.pages.voluntarios.components.identificacion', ['tiposPractica'=> $tiposPractica])
        </fieldset>
        {{-- Cédula / pasaporte - Tipo de práctica --}}
        
        <fieldset>
            @include('admin.pages.voluntarios.components.personal', 
            [
                'paises'         => $paises,
                'generos'        => $generos,
                'estadosciviles' => $estadosciviles,
                'pasatiempos'    => $pasatiempos,
                'universidades'  => $universidades,
                
            ])
        </fieldset>


        <!-- Cultivation FIELD SET -->
        <fieldset>
            <h2 class="fs-title">Cultivation and Nurturing your Donors</h2>
            <h3 class="fs-subtitle">How have you been nurturing donors to get better donations?</h3>
            <!-- Begin Average Gift Size in Year 1 Field -->
            <div class="form-item webform-component webform-component-textfield hs_average_gift_size_in_year_1 field hs-form-field"
                id="edit-submitted-cultivation-amount-1 average_gift_size_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_3256">

                <label
                    for="edit-submitted-cultivation-amount-1 average_gift_size_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_3256">What
                    was your average gift size in year 1? *</label>

                <input id="edit-submitted-cultivation-amount-1" class="form-text hs-input"
                    name="average_gift_size_in_year_1" required="required" size="60" maxlength="128" type="number" value=""
                    placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End Average Gift Size in Year 1 Field -->

            <!-- Begin Average Gift Size in Year 2 Field -->
            <div class="form-item webform-component webform-component-textfield hs_average_gift_size_in_year_2 field hs-form-field"
                id="webform-component-cultivation--amount-2">

                <label
                    for="edit-submitted-cultivation-amount-2 average_gift_size_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_3256">What
                    was your average gift size in year 2? *</label>

                <input id="edit-submitted-cultivation-amount-2" class="form-text hs-input"
                    name="average_gift_size_in_year_2" required="required" size="60" maxlength="128" type="number" value=""
                    placeholder="" data-rule-required="true" data-msg-required="Please enter a valid number">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End Average Gift Size in Year 2 Field -->

            <!-- Begin Average Gift Size Perchent Change Field -->
            <!-- THIS FIELD IS NOT EDITABLE | GRAYED OUT -->
            <div class="form-item webform-component webform-component-textfield webform-container-inline hs_average_gift_size_percent_change field hs-form-field"
                id="webform-component-cultivation--percent-change1">

                <label
                    for="edit-submitted-cultivation-percent-change1 average_gift_size_percent_change-99a6d115-5e68-4355-a7d0-529207feb0b3_3256">Average
                    Gift Size Percent Change</label>

                <input id="edit-submitted-cultivation-percent-change1" class="form-text hs-input"
                    name="average_gift_size_percent_change" readonly="readonly" size="60" maxlength="128" type="text"
                    value="" placeholder="0">
            </div>
            <!-- End Average Gift Size Perchent Change Field -->
            <input type="button" data-page="3" name="previous" class="previous action-button" value="Previous" />
            <input type="button" data-page="3" name="next" class="next action-button" value="Next" />
        </fieldset>



        <!-- Cultivation2 FIELD SET -->
        <fieldset>
            <h2 class="fs-title">Total Cultivation in Donation</h2>
            <h3 class="fs-subtitle">Let's talk about your donations as a whole</h3>
            <!-- Begin Total Giving In Year 1 Field -->
            <div class="form-item webform-component webform-component-textfield"
                id="webform-component-cultivation--amount-3 hs_total_giving_in_year_1 field hs-form-field">

                <label
                    for=" edit-submitted-cultivation-amount-3 total_giving_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_4902">What
                    was your total giving in Year 1? *</label>

                <input id="edit-submitted-cultivation-amount-3" class="form-text hs-input" name="total_giving_in_year_1"
                    required="required" size="60" maxlength="128" type="number" value="" placeholder=""
                    data-rule-required="true" data-msg-required="Please enter a valid number">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End Total Giving In Year 1 Field -->

            <!-- Begin Total Giving In Year 2 Field -->
            <div class="form-item webform-component webform-component-textfield hs_total_giving_in_year_2 field hs-form-field"
                id="webform-component-cultivation--amount-4">

                <label
                    for=" edit-submitted-cultivation-amount-4 total_giving_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_4902">What
                    was your total giving in Year 2? *</label>

                <input id="edit-submitted-cultivation-amount-4" class="form-text hs-input" name="total_giving_in_year_2"
                    required="required" size="60" maxlength="128" type="number" value="" placeholder=""
                    data-rule-required="true" data-msg-required="Please enter a valid number">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>

            <!-- End Total Giving In Year 2 Field -->

            <!-- Begin Average Gift Size Percent Change Field 2 -->
            <!-- THIS FIELD IS NOT EDITABLE | GRAYED OUT -->
            <div class="form-item webform-component webform-component-textfield webform-container-inline hs_total_giving_percent_change field hs-form-field"
                id="webform-component-cultivation--percent-change2">

                <label
                    for=" edit-submitted-cultivation-percent-change2 total_giving_percent_change-99a6d115-5e68-4355-a7d0-529207feb0b3_4902">Average
                    Gift Size Percent Change</label>

                <input id="edit-submitted-cultivation-percent-change2" class="form-text hs-input"
                    name="total_giving_percent_change" readonly="readonly" size="60" maxlength="128" type="text" value=""
                    placeholder="0">
            </div>
            <!-- End Average Gift Size Percent Change Field 2 -->
            <input type="button" data-page="4" name="previous" class="previous action-button" value="Previous" />
            <input type="button" data-page="4" name="next" class="next action-button" value="Next" />
        </fieldset>



        <!-- RETENTION FIELD SET -->
        <fieldset>
            <h2 class="fs-title">Retention of your donors</h2>
            <h3 class="fs-subtitle">How long can you keep your donors and their donations?</h3>
            <!-- Begin Total Number of Donors Who Gave in Year 1 Field -->
            <div class="form-item webform-component webform-component-textfield hs_number_of_donors_in_year_1 field hs-form-field"
                id="webform-component-retention--amount-1">

                <label
                    for=" edit-submitted-retention-amount-1 number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_2983">What
                    was your total number of donors who gave in year 1? *</label>

                <input id="edit-submitted-retention-amount-1" class="form-text hs-input" name="number_of_donors_in_year_1"
                    required="required" size="60" maxlength="128" type="number" value="" placeholder=""
                    data-rule-required="true" data-msg-required="Please enter a valid number">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End Total Number of Donors Who Gave in Year 1 Field-->


            <!-- Begin Total Number of Donors Who Gave in Year 1 and Year 2 Field -->
            <div class="form-item webform-component webform-component-textfield"
                id="webform-component-retention--amount-2 hs_number_of_year_1_donors_who_also_gave_in_year_2 field hs-form-field">

                <label
                    for=" edit-submitted-retention-amount-2 number_of_year_1_donors_who_also_gave_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_2983">What
                    was your total number of donors who gave in year 1 that also gave in year 2? *</label>

                <input id="edit-submitted-retention-amount-2" class="form-text hs-input"
                    name="number_of_year_1_donors_who_also_gave_in_year_2" required="required" size="60" maxlength="128"
                    type="number" value="" placeholder="" data-rule-required="true"
                    data-msg-required="Please enter a valid number">

                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
            <!-- End Total Number of Donors Who Gave in Year 1 and Year 2 Field -->

            <!-- Begin Retention Rate Percent -->
            <div class="form-item webform-component webform-component-textfield"
                id="webform-component-retention--percent-change field hs-form-field">

                <label for="edit-submitted-retention-percent-change">Retention Rate</label>

                <input id="edit-submitted-retention-percent-change" class="form-text hs-input" name="retention_rate_percent"
                    readonly="readonly" size="60" maxlength="128" type="text" value="" placeholder="0">

                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>

            <!-- End Retention Rate Percent -->


            <!-- Begin Final Calc -->
            <div class="form-item webform-component webform-component-textfield hs_fundraising_400_index field hs-form-field"
                id="webform-component-final-grade--grade">

                <label for=" fundraising_400_index-99a6d115-5e68-4355-a7d0-529207feb0b3_2983">Fundraising 400 Index
                    Score</label>

                <input id="edit-submitted-final-grade-grade" class="form-text hs-input" name="fundraising_400_index"
                    readonly="readonly" size="60" maxlength="128" type="text" value="" placeholder="0">
            </div>
            <!-- End Final Calc -->
            <input type="button" data-page="5" name="previous" class="previous action-button" value="Previous" />
            <input id="submit" class="hs-button primary large action-button next" type="submit" value="Submit">
        </fieldset>

        <fieldset>
            <h2 class="fs-title">It's on the way!</h2>
            <h3 class="fs-subtitle">Thank you for trying out our marketing grader, please go check your email for your
                fundraising report card and some helpful tips to improve it!</h3>
        </fieldset>

        {{-- Scripts para esta sección --}}
        @include('admin.pages.voluntarios.components.scripts')
        <script>
        </script>
    @endsection
