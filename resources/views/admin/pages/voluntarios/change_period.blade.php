@extends('admin.templates.template')
@section('styles_cdn')
    <link rel="stylesheet" href="http://www.bufa.es/wp-content/themes/bufa/css/google-maps-latitud-longitud.css?ver=4.7.3" type="text/css" media="all" />
    <style>
        .select2-selection__choice{
            background: rgb(0, 129, 90) !important;
        }
    </style>
@endsection
@section('content')
    @include('components.alerts.errorBags')
    <form class="steps" method="POST" action="{{ route('admin.voluntarios.cambio_periodo.store') }}" accept-charset="UTF-8" onsubmit="return crearVoluntario()" autocomplete="on">
        @csrf
        <ul id="progressbar" class="flex flex-center-x">
            <li class="active">{{ trans('global.voluntarios.create.personal-data') }}</li>
            <li>{{ trans('global.voluntarios.create.academic') }}</li>
            <li>{{ trans('global.voluntarios.create.bspi') }}</li>
            <li>{{ trans('global.voluntarios.create.schedule') }}</li>
        </ul>
        {{-- Cédula / pasaporte - Datos personales --}}
        <fieldset class="min-fs">
            @include('admin.pages.voluntarios.components.info_voluntario', ['tiposPractica'=> $tiposPractica, 'voluntario'=> $voluntario])
        </fieldset>
        


        <!-- PASO 3: INFORMACIÓN ACADÉMICA -->
        <fieldset class="min-fs">
            @include('admin.pages.voluntarios.components.academico', 
            [
                'universidades'  => $universidades,
                'unidades_bspi'  => $unidades_bspi,
                // 'departamentos'  => $departamentos,
                // 'alimentaciones' => $alimentaciones
            ])
        </fieldset>

        <!-- PASO 4: INFORMACIÓN BSPI -->
        <fieldset class="min-fs">
            
            @include('admin.pages.voluntarios.components.bspi', 
            [
                'unidades_bspi'  => $unidades_bspi,
                'departamentos'  => $departamentos,
                'alimentaciones' => $alimentaciones
            ])
        </fieldset>



        <!-- RETENTION FIELD SET -->
        <fieldset class="fieldset-all">
            @include('admin.pages.voluntarios.components.horario', [
                'horas'  => $horas
            ])
        <input type="button" data-page="5" name="previous" class="previous action-button" value="Anterior" />
        <input id="submit" class="hs-button primary large action-button next" type="submit" value="Enviar">
        </fieldset>
        {{-- Scripts para esta sección --}}
        @include('admin.pages.voluntarios.components.script-change-period')
        <script>
        </script>
    </form>
    @endsection
