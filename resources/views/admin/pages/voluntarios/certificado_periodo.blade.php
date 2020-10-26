<div class="card">
    <div class="card-header">
        <div class="d-inline">{{ trans('global.evaluation') }}</div>
    </div>

    <div class="card-body">
        @foreach ($item as $evaluacion)
            <form class="m-2" action="{{ route('admin.certificados.generar.certificado', ['id' => $evaluacion->id]) }}" method="get"
                target="_blank">
                <input type="hidden" name="tipo" value="{{ $evaluacion->periodo === null ? 'evaluacion' : 'periodo' }}">
                <input type="hidden" name="pasaporte" value="{{ $evaluacion->Pasaporte }}">
                <button type="submit" class="btn btn-warning">
                    Periodo:
                    {{ $evaluacion->periodo === null ? ($evaluacion->voluntario !== null ? $evaluacion->voluntario->FechaInicio . ' - ' . $evaluacion->voluntario->FechaFin : '') : $evaluacion->periodo->fecha_inicio . ' - ' . $evaluacion->periodo->fecha_fin }}
                    <span class="badge badge-light"><i class="fas fa-file-download"></i></span>
                    <span class="sr-only">unread messages</span>
                </button>
            </form>
        @endforeach
    </div>
</div>
