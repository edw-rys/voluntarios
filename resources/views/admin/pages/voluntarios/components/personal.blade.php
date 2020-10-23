<h2 class="fs-title">{{ trans('global.voluntarios.create.personal-data') }}</h2>
<div class="row">
    <div class="col-md-6">
        {{-- Nombres --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">

            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">{{ trans('global.voluntarios.create.names') }}</label>
            <div class="flex">
                <div class="form-group m-0 pl-2">
                    <input class="form-control m-0  form-control-sm hs-input" name="Nombres" id="Nombres"
                        required="required" placeholder="Primer Nombre" value="" placeholder=""
                        data-rule-required="true" data-msg-required="Escriba su Primer Nombre">
                    <span class="error1" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>
                </div>
                <div class="form-group m-0 pl-2">
                    <input class="form-control  m-0 form-control-sm hs-input" name="nombreSegundo" id="nombreSegundo"
                        placeholder="Segundo nombre" required="required" value="" placeholder=""
                        data-rule-required="true" data-msg-required="Escriba su segundo nombre">
                    <span class="error1" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>
                </div>
            </div>
        </div>
        {{-- Apellidos --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">
            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Apellidos</label>
            <div class="flex">
                <div class="form-group m-0 pl-2">
                    <input class="form-control  m-0 form-control-sm hs-input" name="Apellidos" id="Apellidos"
                        placeholder="Primer Apellido" required="required" value="" placeholder=""
                        data-rule-required="true" data-msg-required="Esciba su apellido">
                    <span class="error1" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>
                </div>
                <div class="form-group m-0 pl-2">
                    <input class="form-control  m-0 form-control-sm hs-input" name="apellidoMaterno"
                        id="apellidoMaterno" placeholder="Segundo Apellido" required="required" value="" placeholder=""
                        data-rule-required="true" data-msg-required="Esciba sus apellido materno">
                    <span class="error1" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>
                </div>
            </div>
        </div>
        {{-- Género --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Genero</label>
            <select name="genero" id="genero" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" required>
                @foreach ($generos as $id => $genero)
                    <option value="{{ $genero->codigo }}" {{ old('genero') === $genero->codigo ? 'selected' : '' }}>
                        {{ $genero->descripcion }}
                    </option>
                @endforeach

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        {{-- Dirección --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">

            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Dirección</label>
            <div class="form-group m-0 pl-2">
                <input class="form-control m-0  form-control-sm hs-input" name="Direccion" id="Direccion" type="text"
                    required="required" placeholder="Dirección de residencia actual"
                    data-rule-required="true" data-msg-required="Escriba la dirección">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
         {{-- Correo --}}
        <div class=" relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">
            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Correo</label>
            <div class="form-group m-0 pl-2">
                <input class="form-control m-0  form-control-sm hs-input" name="Correo" id="Correo" required="required" type="email"
                    placeholder="Dirección de correo electrónico" data-rule-required="true" data-msg-required="Escriba la dirección">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
        {{-- Fecha --}}
        <div class=" relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">
            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">F. de nacimiento</label>
            <div class="form-group m-0 pl-2">
                <input class="form-control m-0  form-control-sm hs-input" name="FechaNacimiento" id="FechaNacimiento" type="date"
                    placeholder="Fecha de nacimiento" data-rule-required="true"
                    data-msg-required="Seleccione la fecha">
                <span class="error1" style="display: none;">
                    <i class="error-log fa fa-exclamation-triangle"></i>
                </span>
            </div>
        </div>
    </div>
    <div class="col-md-6">
        {{-- Estados civiles --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Estado Civil</label>
            <select name="EstadoCivil" id="EstadoCivil" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" required>
                @foreach ($estadosciviles as $id => $civil)
                    <option value="{{ $civil->id }}" {{ old('EstadoCivil') === $civil->id ? 'selected' : '' }}>
                        {{ $civil->Nombre }}
                    </option>
                @endforeach

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        {{-- Paises --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">País</label>
            <select name="Pais" id="Pais" class="form-control select2" onchange="cargarCiudades(this.value)"
                data-placeholder="{{ trans('global.pleaseSelect') }}" required>
                @foreach ($paises as $id => $pais)
                    <option value="{{ $pais->id }}" {{ old('Pais') === $pais->id ? 'selected' : '' }}>
                        {{ $pais->Nombre }}
                    </option>
                @endforeach

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        {{-- Ciudades --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Ciudad</label>
            <select name="Cuidad" id="Cuidad" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" required>

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        {{-- Pasatiempo --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_2 field hs-form-field"
            id="webform-component-acquisition--amount-2">

            <label
                for="edit-submitted-acquisition-amount-2 total_number_of_donors_in_year_2-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Pasatiempo</label>
            <select name="CodigoReferencia" id="CodigoReferencia" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" required>
                @foreach ($pasatiempos as $id => $pasatiempo)
                    <option value="{{ $pasatiempo->id }}" {{ old('CodigoReferencia') === $pasatiempo->id ? 'selected' : '' }}>
                        {{ $pasatiempo->NombrePasatiempo }}
                    </option>
                @endforeach

            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        {{-- Teléfono --}}
        <div class="relative form-item webform-component webform-component-textfield hs_total_number_of_donors_in_year_1 field hs-form-field"
            id="webform-component-acquisition--amount-1">
            <label
                for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Teléfono</label>
            <div class="flex">
                <div class="form-group m-0 pl-2">
                    <input class="form-control  m-0 form-control-sm hs-input" name="Telefono" id="Telefono"
                        placeholder="Teléfono" required="required" value=""
                        data-rule-required="true" data-msg-required="Esciba su teléfono">
                    <span class="error1" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>
                </div>
                <div class="form-group m-0 pl-2">
                    <input class="form-control  m-0 form-control-sm hs-input" name="celular"
                        id="celular" placeholder="Celular" required="required" value=""
                        data-rule-required="true" data-msg-required="Esciba número de celular">
                    <span class="error1" style="display: none;">
                        <i class="error-log fa fa-exclamation-triangle"></i>
                    </span>
                </div>
            </div>
        </div>
    </div>

</div>

@include('admin.pages.voluntarios.components.buttons-next-prev',[
    'page'  => 3
])
