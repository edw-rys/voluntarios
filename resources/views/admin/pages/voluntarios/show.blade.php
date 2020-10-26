<div class="card">
    <div class="card-header">
        <div class="d-inline">Voluntario</div>
    </div>

    <div class="card-body">
        <table class="table table-bordered table-striped">
            <tbody>
                <tr>
                    <th>{{ trans('global.voluntario.identification_number') }} </th>
                    <td>{{ $item->Pasaporte }}</td>
                </tr>
                <tr>
                    <th>{{ trans('global.voluntario.names') }} </th>
                    <td>{{ $item->Apellidos }} {{ $item->apellidoMaterno }} {{ $item->Nombres }} {{ $item->nombreSegundo }}</td>
                </tr>
                <tr>
                    <th>Genero </th>
                    <td>{{ $item->genero_detalle->descripcion }}</td>
                </tr>
                <tr>
                    <th>País </th>
                    <td>{{ $item->pais_detalle !== null  ? $item->pais_detalle->Nombre : $item->pais }}</td>
                </tr>
                <tr>
                    <th>Ciudad</th>
                    <td>{{ $item->ciudad_detalle !== null ? $item->ciudad_detalle->Nombre : $item->ciudad }}</td>
                </tr>
            </tbody>
        </table>
        <table style="width: 900px" border="1">
            <thead>
                <tr>
                    <th class="text-center">{{ trans('global.voluntario.university') }}</th>
                    <th class="text-center">{{ trans('global.voluntario.carrera') }}</th>
                    <th class="text-center">{{ trans('global.voluntario.unity') }}</th>
                    <th class="text-center">{{ trans('global.voluntario.department') }}</th>
                    <th class="text-center">{{ trans('global.voluntario.tipo_practica') }}</th>
                    <th class="text-center">{{ trans('global.voluntario.tutor_bspi') }}</th>
                    <th class="text-center">{{ trans('global.voluntario.start_date') }}</th>
                    <th class="text-center">{{ trans('global.voluntario.end_date') }}</th>
                </tr>
            </thead>
            <tbody>
                @if (isset($item->universidad) && $item->universidad !== null)
                    <tr>
                        <td class="text-center" style="min-width: 200px">{{ $item->universidad !== null ? $item->universidad->Nombre : ''}}</td>
                        <td class="text-center" style="min-width: 200px">{{ $item->Carrera }}</td>
                        <td class="text-center" style="min-width: 200px">{{ $item->unidad !== null ? $item->unidad->Nombre : ''}}</td>
                        <td class="text-center" style="min-width: 200px">{{ $item->departamento !== null ? $item->departamento->Nombre : ''}}</td>
                        <td class="text-center" style="min-width: 200px">{{ $item->tipo_practica !== null ? $item->tipo_practica->descripcion : ''}}</td>
                        <td class="text-center" style="min-width: 200px">{{ $item->TutorBspi }}</td>
                        <td class="text-center" style="min-width: 200px">{{ $item->FechaInicio}}</td>
                        <td class="text-center" style="min-width: 200px">{{ $item->FechaFin}}</td>
                    </tr>
                @endif

                @if (isset($item->periodos) && count($item->periodos)>0)
                    @foreach ($item->periodos as $periodo)
                        <tr>
                            <td class="text-center" style="min-width: 200px">{{ $periodo->universidad !== null ? $periodo->universidad->Nombre : ''}}</td>
                            <td class="text-center" style="min-width: 200px">{{ $periodo->carrera }}</td>
                            <td class="text-center" style="min-width: 200px">{{ $periodo->unidad !== null ? $periodo->unidad->Nombre : ''}}</td>
                            <td class="text-center" style="min-width: 200px">{{ $periodo->departamento !== null ? $periodo->departamento->Nombre : ''}}</td>
                            <td class="text-center" style="min-width: 200px">{{ $periodo->tipo_practica !== null ? $periodo->tipo_practica->descripcion : ''}}</td>
                            <td class="text-center" style="min-width: 200px">{{ $periodo->tutor_bspi_nombre }}</td>
                            <td class="text-center" style="min-width: 200px">{{ $periodo->fecha_inicio}}</td>
                            <td class="text-center" style="min-width: 200px">{{ $periodo->fecha_fin}}</td>
                        </tr>
                    @endforeach
                @endif
                    
            </tbody>
        </table>
    </div>
</div>
