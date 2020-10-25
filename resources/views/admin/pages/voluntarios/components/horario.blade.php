<h2 class="fs-title">{{ trans('global.voluntarios.create.passport-title') }}</h2>


<!-- End Total Number of Donors in Year 1 Field -->

<!-- Begin Total Number of Donors in Year 2 Field -->
<div class="">
    <div class="row flex-center-x">
        <div class="col-md-5">
            <label for="roles">Lunes
                <span class="btn btn-info btn-xs select-all">Seleccionar todols</span>
                <span class="btn btn-info btn-xs deselect-all">Quitar todos</span>
            </label>
            <select name="horas_lunes[]" id="horas_lunes" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" multiple="multiple" onchange="calculaHora()">
                <option></option>
                @foreach ($horas as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->detalle }}</option>
                @endforeach
            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        <div class="col-md-5">
            <label for="roles">Martes
                <span class="btn btn-info btn-xs select-all">Seleccionar todols</span>
                <span class="btn btn-info btn-xs deselect-all">Quitar todos</span>
            </label>
            <select name="horas_martes[]" id="horas_martes" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" multiple="multiple" onchange="calculaHora()">
                <option></option>
                @foreach ($horas as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->detalle }}</option>
                @endforeach
            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
    </div>

    <div class="row flex-center-x">
        <div class="col-md-5">
            <label for="roles">Miércoles
                <span class="btn btn-info btn-xs select-all">Seleccionar todols</span>
                <span class="btn btn-info btn-xs deselect-all">Quitar todos</span>
            </label>
            <select name="horas_miercoles[]" id="horas_miercoles" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" multiple="multiple" onchange="calculaHora()">
                <option></option>
                @foreach ($horas as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->detalle }}</option>
                @endforeach
            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        <div class="col-md-5">
            <label for="roles">Jueves
                <span class="btn btn-info btn-xs select-all">Seleccionar todols</span>
                <span class="btn btn-info btn-xs deselect-all">Quitar todos</span>
            </label>
            <select name="horas_jueves[]" id="horas_jueves" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" multiple="multiple" onchange="calculaHora()">
                <option></option>
                @foreach ($horas as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->detalle }}</option>
                @endforeach
            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
    </div>

    <div class="row flex-center-x">
        <div class="col-md-5">
            <label for="roles">Viernes
                <span class="btn btn-info btn-xs select-all">Seleccionar todols</span>
                <span class="btn btn-info btn-xs deselect-all">Quitar todos</span>
            </label>
            <select name="horas_viernes[]" id="horas_viernes" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" multiple="multiple" onchange="calculaHora()">
                <option></option>
                @foreach ($horas as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->detalle }}</option>
                @endforeach
            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
        <div class="col-md-5">
            <label for="roles">Sábado
                <span class="btn btn-info btn-xs select-all">Seleccionar todols</span>
                <span class="btn btn-info btn-xs deselect-all">Quitar todos</span>
            </label>
            <select name="horas_sabado[]" id="horas_sabado" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" multiple="multiple" onchange="calculaHora()">
                <option></option>
                @foreach ($horas as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->detalle }}</option>
                @endforeach
            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
    </div>
    <div class="row flex-center-x">
        <div class="col-md-5">
            <label for="roles flex">
                <span>Domingo</span>
                <span>
                    <span class="btn btn-info btn-xs select-all">Seleccionar todols</span>
                    <span class="btn btn-info btn-xs deselect-all">Quitar todos</span>
                </span>
            </label>
            <select name="horas_domingo[]" id="horas_domingo" class="form-control select2"
                data-placeholder="{{ trans('global.pleaseSelect') }}" multiple="multiple" onchange="calculaHora()">
                <option></option>
                @foreach ($horas as $horario)
                    <option value="{{ $horario->id }}">{{ $horario->detalle }}</option>
                @endforeach
            </select>
            <span class="error1" style="display: none;">
                <i class="error-log fa fa-exclamation-triangle"></i>
            </span>
        </div>
    </div>
</div>
<div class="part-2--">
    <div class="row flex flex-center-x">
        <div class="col-md-5">
            {{-- Fechas inicio -fin --}}
            <div class="row">
                <div class="col-md-12">
                    <label
                        for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Fecha
                        de inicio</label>
                    <div class="form-group m-0 pl-2">
                        <input class="form-control m-0  form-control-sm hs-input" name="FechaInicio" id="FechaInicio"
                            type="date" onchange="calculaHora()">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12">
                    <label
                        for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Fecha
                        de fin</label>
                    <div class="form-group m-0 pl-2">
                        <input class="form-control m-0  form-control-sm hs-input" name="FechaFin" id="FechaFin"
                            type="date" onchange="calculaHora()">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-md-5">
            <div class="row">
                <div class="col-12">
                    <label for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Horas programadas</label>
                    <div class="form-group m-0 pl-2">
                        <input class="form-control m-0  form-control-sm hs-input" name="HorasProgramada" id="HorasProgramada"
                            required="required" type="text" placeholder="Horas programadas">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
                <div class="col-12">
                    <label for="edit-submitted-acquisition-amount-1 total_number_of_donors_in_year_1-99a6d115-5e68-4355-a7d0-529207feb0b3_6344">Horario</label>
                    <div class="form-group m-0 pl-2">
                        <input class="form-control m-0  form-control-sm hs-input" name="Horario" id="Horario"
                            required="required" type="text" placeholder="Horario">
                        <span class="error1" style="display: none;">
                            <i class="error-log fa fa-exclamation-triangle"></i>
                        </span>
                    </div>
                </div>
            </div>
        </div>
    </div>

</div>