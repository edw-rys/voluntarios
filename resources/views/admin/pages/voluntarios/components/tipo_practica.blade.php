<h2 class="fs-title">{{ trans('global.voluntarios.create.passport-title') }}</h2>

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

<div class="input-group mb-3 mt-3" >
  <div class="custom-file">
    <input type="file" class="custom-file-input" id="imagen" aria-describedby="inputGroupFileAddon01" name="imagen">
    <label class="custom-file-label" for="imagen">Buscar imágen</label>
  </div>
</div>
@include('admin.pages.voluntarios.components.buttons-next-prev',[
    'page'  => 2
])
