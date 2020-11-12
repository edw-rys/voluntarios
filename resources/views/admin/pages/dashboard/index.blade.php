@extends('admin.templates.template')
{{-- @include('admin.partials.datatable') --}}
@section('styles_cdn')
    <style>
       .chartWrapper {
          position: relative;
        }

        .chartWrapper > canvas {
          position: absolute;
          left: 0;
          top: 0;
          pointer-events: none;
        }

        .chartAreaWrapper {
          width: 100%;
          overflow-x: scroll;
        }
    </style>
@endsection

@section('content')

   

    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Opciones</h1>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-info"><i class="far fa-envelope"></i></span>

                        <div class="info-box-content">
                            <a href="{{ route('admin.voluntarios.index') }}">
                                <span class="info-box-text">Voluntariado</span>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-success"><i class="far fa-flag"></i></span>

                        <div class="info-box-content">
                            <a href="{{ route('admin.evaluaciones.index') }}">
                                <span class="info-box-text">Evaluaciones</span>
                            </a>
                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
                <div class="col-md-3 col-sm-6 col-12">
                    <div class="info-box">
                        <span class="info-box-icon bg-warning"><i class="far fa-copy"></i></span>

                        <div class="info-box-content">
                            <a href="{{ route('admin.certificados.index') }}">
                                <span class="info-box-text">Certificado</span>
                            </a>

                        </div>
                        <!-- /.info-box-content -->
                    </div>
                    <!-- /.info-box -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->

        </div><!-- /.container-fluid -->
    </section>
    <section class="" style="margin: 50px auto;">
        <h1 class="text-center">Diagramas</h1>
        <div class="">
            <div style="margin: 20px 50px; ">
            
            @foreach (config('app_voluntarios.modos_graficos') as $tipo_grafico)
                @foreach (config('app_voluntarios.graficos')  as $item)
                    <h3 class="text-center">{{ $item->titulo }}</h3>
                    <div class="chartWrapper">
                        <div class="chartAreaWrapper">
                        <div class="chartAreaWrapper2">
                          <canvas id="{{ $item->id }}-{{ $tipo_grafico->nombre }}" height="300" width="1200"></canvas>
                        </div>
                        </div>
                        <canvas id="{{ $item->id }}-{{ $tipo_grafico->nombre }}axis-Test" height="300" width="0"></canvas>
                    </div>
                @endforeach 
            @endforeach
            </div>
        </div>
    </section>
    <div class="container">
    </div>
    <!-- /.content -->
    @include('admin.pages.dashboard.script')

    <a id="back-to-top" href="#" class="btn btn-primary back-to-top" role="button" aria-label="Scroll to top">
        <i class="fas fa-chevron-up"></i>
    </a>
@endsection
