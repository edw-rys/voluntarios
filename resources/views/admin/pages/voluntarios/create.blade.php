@extends('admin.templates.template')
@section('styles_cdn')
    {{-- <link rel="stylesheet" href="http://www.bufa.es/wp-content/themes/bufa/css/google-maps-latitud-longitud.css?ver=4.7.3" type="text/css" media="all" /> --}}
    <link rel="stylesheet" href="{{ asset('css/mapstyle.css') }}">

    <style>
        .select2-selection__choice{
            background: rgb(0, 129, 90) !important;
        }
    </style>
@endsection
@section('content')
    @include('components.alerts.errorBags')
    <form class="steps" method="POST" action="{{ route('admin.voluntarios.store') }}" accept-charset="UTF-8" onsubmit="return crearVoluntario()" autocomplete="on" enctype="multipart/form-data">
        @csrf
        <ul id="progressbar">
            <li class="active">{{ trans('global.voluntarios.create.maps') }}</li>
            {{-- <li>{{ trans('global.voluntarios.create.maps') }}</li> --}}
            <li>{{ trans('global.voluntarios.create.passport-title') }}</li>
            <li>{{ trans('global.voluntarios.create.personal-data') }}</li>
            <li>{{ trans('global.voluntarios.create.academic') }}</li>
            <li>{{ trans('global.voluntarios.create.bspi') }}</li>
            <li>{{ trans('global.voluntarios.create.schedule') }}</li>
        </ul>
        {{-- Mapas para selecciona la ubicación --}}
        {{-- <fieldset>
            @include('admin.pages.voluntarios.components.personal', 
            [
                'paises'         => $paises,
                'generos'        => $generos,
                'estadosciviles' => $estadosciviles,
                'pasatiempos'    => $pasatiempos,
                'universidades'  => $universidades,
                
            ])
        </fieldset> --}}
        
        {{-- Maps --}}
        <fieldset class="min-fs">
            <h2 class="fs-title">Ubicación</h2>
            <h3 class="fs-subtitle">Busque su ubicación y de clic en siguiente.</h3>
            @include('admin.pages.voluntarios.components.maps')
            <!-- End Total Number of Constituents in Your Database Field -->
            <input type="button" data-page="1" name="next" class="next action-button" value="Next" />
        </fieldset>
        {{-- Cédula / pasaporte - Tipo de práctica --}}
        <fieldset class="min-fs">
            @include('admin.pages.voluntarios.components.identificacion', ['tiposPractica'=> $tiposPractica])
        </fieldset>
        {{-- Cédula / pasaporte - Tipo de práctica --}}
        
        <fieldset class="min-fs">
            @include('admin.pages.voluntarios.components.personal', 
            [
                'paises'         => $paises,
                'generos'        => $generos,
                'estadosciviles' => $estadosciviles,
                'pasatiempos'    => $pasatiempos,
                'universidades'  => $universidades,
                
            ])
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
        <input id="submit" class="hs-button primary large action-button" type="submit" value="Enviar">
        </fieldset>
        {{-- Scripts para esta sección --}}
        <script type="text/javascript" src="{{ asset('js/validates/expreg.js') }}"></script>
        <script type="text/javascript" src="{{ asset('js/validates/creacion-voluntario.js') }}"></script>
        <script>
            var facultad_selected = 0, tutor_selected = 0;
        </script>
        @include('admin.pages.voluntarios.components.scripts')
        <script>
            var validaVentana__ = validaVentana;
                $(document).ready(function() {
                initialize();
                cargarCiudades($('#Pais').val(),73);
            });
        </script>
        <script>
            cargarCiudades($('#Pais').val(),73);
        </script>
    </form>
@endsection
