<h2 class="fs-title">{{ trans('global.voluntarios.create.academic') }}</h2>
<div class="row flex-center-x">
    <div class="col-md-6">

        {{-- Universidad --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Universidad
                / Instituto</label>
            <select name="Universidad" id="Universidad" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" onchange="cargarFacultades(this.value)" required>
                <option value="0" ></option>
                @foreach ($universidades as $id => $universidad)
                    <option value="{{ $universidad->id }}"
                        {{ isset($periodo) && $periodo!=null ? ($periodo->universidad_id == $universidad->id ? 'selected' :''):''  }}>
                        {{ $universidad->Nombre }}
                    </option>
                @endforeach

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        {{-- Facultades --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Facultad</label>
            <select name="Facultad" id="Facultad" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" required>

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>

    </div>
    <div class="col-md-6">
        {{-- Carrera --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">

            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Carrera</label>
            <div class="form-group m-0 pl-2">
                <input class="form-control m-0  form-control-sm hs-input" name="Carrera" id="Carrera" type="text"
                    required="required" placeholder="Carrera" data-rule-required="true" value="{{ isset($periodo) && $periodo !==null ? $periodo->carrera : '' }}"
                    data-msg-required="Escriba en nombre de la carrera">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
        {{-- Semestre --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">

            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Nivel
                / Semestre / Año</label>
            <div class="form-group m-0 pl-2">
                <input class="form-control m-0  form-control-sm hs-input" name="Nivel" id="Nivel" type="text" value="{{ isset($periodo) && $periodo !==null ? $periodo->nivel : '' }}"
                    required="required" placeholder="Semestre cursando" data-rule-required="true"
                    data-msg-required="Semestre que cursa">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-10">
        {{-- Semestre --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">

            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Tutor Académico</label>
            <div class="form-group m-0 pl-2">
                <input class="form-control m-0  form-control-sm hs-input" name="Tutor" id="Tutor" type="text" value="{{ isset($periodo) && $periodo !==null ? $periodo->tutor : '' }}"
                    required="required" placeholder="Tutor" data-rule-required="true"
                    data-msg-required="Escriba el nombre del Tutor">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
    </div>

</div>

@include('admin.pages.voluntarios.components.buttons-next-prev',[
    'page'  => 4
])
