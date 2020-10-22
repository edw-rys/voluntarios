<h2 class="fs-title">{{ trans('global.voluntarios.create.passport-title') }}</h2>

<div class="form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
    id="webform-component-acquisition--amount-1">

    <label
        for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">{{ trans('global.voluntarios.create.passport') }}</label>

    <input class="form-text hs-input" name="Pasaporte" id="Pasaporte" required="required" value="" placeholder=""
        data-rule-required="true" data-msg-required="{{ trans('global.voluntarios.create.errors.passport') }}">
    <span class="error1" style="display: none;">
        <i class="error-log fa fa-exclamation-triangle"></i>
    </span>
</div>
<!-- End Total Number of Donors in Year 1 Field -->

<!-- Begin Total Number of Donors in Year 2 Field -->
<div class="form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
    id="webform-component-acquisition--amount-2">

    <label
        for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">{{ trans('global.voluntarios.create.tipo_practica') }}</label>
    <select name="tipoPractica" id="tipoPractica" class="form-control select2" data-placeholder="{{ trans('global.pleaseSelect') }}"
        required>
        @foreach ($tiposPractica as $id => $tipo)
            <option value="{{ $tipo->codigo }}" {{ old('tipoPractica') ===  $tipo->codigo ? 'selected' : '' }}>
                {{ $tipo->descripcion }}
            </option>
        @endforeach

    </select>
    <span class="error1" style="display: none;">
        <i class="error-log fa fa-exclamation-triangle"></i>
    </span>
</div>

<!-- End Calc of Total Number of Donors Fields -->
<input type="button" data-page="2" name="previous" class="previous action-button" value="Previous" />
<input type="button" data-page="2" name="next" class="next action-button" value="Next" />
