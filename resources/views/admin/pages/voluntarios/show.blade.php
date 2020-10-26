<div class="card">
    <div class="card-header">
        <div class="d-inline">{{ trans('global.collection.title') }}</div>
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
    </div>
</div>
