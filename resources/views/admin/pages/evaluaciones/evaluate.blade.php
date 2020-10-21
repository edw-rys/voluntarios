<div class="card">
    <div class="card-header">
        <div class="d-inline">{{ trans('global.evaluation') }}</div>
    </div>

    <div class="card-body">
        <form action="{{ route('admin.evaluaciones.evaluate.post',$item->id) }}" onsubmit="return validarEvaluaciones()" method="POST">
            <input type="hidden" name="CodigoReferencia" value="{{ $item->id  }}">
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" width="30%">COLUMNA</th>
                        <th scope="col">VALOR</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="trow_bkc">
                        <th>{{ trans('global.evaluate.show.code') }}</th>
                        <td>{{ $item->id }}</td>
                    </tr>
                    <tr class="trow_bkc">
                        <th>{{ trans('global.evaluate.show.name') }}</th>
                        <td>{{ $item->Apellidos . ' ' .$item->Nombres }}</td>
                    </tr>
                    <tr class="trow_bkc">
                        <th>{{ trans('global.evaluate.show.passport') }}</th>
                        <td>{{ $item->Pasaporte }}</td>
                    </tr>
                    <tr class="trow_bkc">
                        <th>{{ trans('global.evaluate.show.email') }}</th>
                        <td>{{ $item->Correo }}</td>
                    </tr>
                    <tr class="trow_bkc">
                        <th>{{ trans('global.evaluate.show.university') }}</th>
                        <td>{{ $item->universidad !== null ? $item->universidad->Nombre : $item->Universidad }}</td>
                    </tr>
                    <tr class="trow_bkc">
                        <th>{{ trans('global.evaluate.show.period') }}</th>
                        <td>{{ $item->FechaInicio . ' - ' . $item->FechaFin }}</td>
                    </tr>
                </tbody>
            </table>
            <div class="row flex flex-center-x mt-4 mb-2">
                <span class="bold">EVALUACIÓN DEL DESEMPEÑO</span>
            </div>
            @if (trans('cuestionario.preguntas_c') !== null && is_array(trans('cuestionario.preguntas_c')))     
                @foreach (trans('cuestionario.preguntas_c') as $grupo)    
                    <table class="table table-bordered table-striped">
                        {{-- @dump($grupo) --}}
                        <thead>
                            <tr>
                                <th scope="col" style="font-weight: 800">{{ $grupo->nombre }}</th>
                                <th scope="col"  width="20%">CALIFICACIÓN</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($grupo->preguntas as $pregunta)
                                <tr>
                                    <th style="font-weight: 500">{{ $pregunta->pregunta }}</th>
                                    <td>
                                        <input style="outline: none" placeholder="[ 0 - 100]" class="input-evaluate-field border border-success" type="number" name="{{ $pregunta->input }}" id="" value="50" required>
                                        {{-- <span class="error_log hidden text-danger">Error</span> --}}
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                @endforeach
            @endif
            <table class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th scope="col" style="font-weight: 800">Recoumendación</th>
                        <th scope="col"  width="20%">Valor</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th style="font-weight: 500">Recomendaría este pasante para laborar</th>
                        <td>
                            <label for="txtsi">Si</label>
                            <input style="outline: none" class="border border-success" type="radio" name="txtrecomendado" id="txtsi" value="si">
                            <label for="txtno">No</label>
                            <input style="outline: none" class="border border-success" type="radio" name="txtrecomendado" id="txtno" value="no">
                            {{-- <span class="error_log hidden text-danger">Error</span> --}}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="flex flex-center-x mt-3 mb-3">
                <button class="btn btn-primary">{{ trans('global.buttons.save') }}</button>
            </div>
        </form>
    </div>
</div>