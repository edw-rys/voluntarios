<h2 class="fs-title">Información y tipo de práctica</h2>

<div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
    id="webform-component-acquisition--amount-1">

    <div class="row">
        <div class="col-12">
            <p class="text-center">Nombres y apellidos</p>
            <p class="text-center">{{ $voluntario->Nombres }} {{ $voluntario->nombreSegundo }} {{ $voluntario->Apellidos }} {{ $voluntario->apellidoMaterno }}</p>
        </div>
        <div class="col-12">
            <p class="text-center">Pasaporte</p>
            <p class="text-center">{{ $voluntario->Pasaporte }}</p>
        </div>
        <input type="hidden" name="voluntario_id" value="{{ $voluntario->id}}">
    </div>
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

<input type="button" data-page="1" name="next" class="next action-button" value="Siguiente" />
