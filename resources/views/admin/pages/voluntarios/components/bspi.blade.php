<h2 class="fs-title">{{ trans('global.voluntarios.create.bspi') }}</h2>
<div class="row flex-center-x">
    <div class="col-md-6">
        {{-- Unidad BSPI --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Unidad
                BSPI</label>
            <select name="Unidad" id="Unidad" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" required>
                @foreach ($unidades_bspi as $id => $unidad)
                    <option value="{{ $unidad->id }}" {{ old('Unidad') === $unidad->id ? 'selected' : '' }}>
                        {{ $unidad->Nombre }}
                    </option>
                @endforeach

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        {{-- Departamentos --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Departamento</label>
            <select name="Departamento" id="Departamento" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" onchange="cargarTutorBSPIes(this.value)" required>
                @foreach ($departamentos as $id => $departamento)
                    <option value="{{ $departamento->id }}"
                        {{ old('Departamento') === $departamento->id ? 'selected' : '' }}>
                        {{ $departamento->Nombre }}
                    </option>
                @endforeach

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        {{-- TutorBSPI --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">
            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Tutor BSPI</label>
            <select name="idtutor" id="idtutor" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" required>

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
    </div>
    <div class="col-md-6">
        {{-- Proyecto --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">

            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Proyecto</label>
            <div class="form-group m-0 pl-2">
                <input class="form-control m-0  form-control-sm hs-input" name="Proyecto" id="Proyecto" type="text"
                    required="required" placeholder="Proyecto" data-rule-required="true"
                    data-msg-required="Escriba en nombre del proyecto">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
        {{-- ¿El voluntario leyó las normativas? --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">

            <label for="">¿El voluntario leyó las normativas?</label>
            <div class="m-0 pl-2 flex">
                <input class="form-control m-0  form-control-sm hs-input" name="chkActa" id="chkActa" type="checkbox"
                    required="required" data-rule-required="true" data-msg-required="Marque el campo">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
        {{-- Observación --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">

            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Observación</label>
            <div class="form-group m-0 pl-2">
                <input class="form-control m-0  form-control-sm hs-input" name="observacion" id="observacion"
                    type="text" required="required" placeholder="observación" data-rule-required="true"
                    data-msg-required="">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>


    </div>
    <div class="col-md-10">

    </div>

</div>

@include('admin.pages.voluntarios.components.buttons-next-prev',[
'page' => 5
])
