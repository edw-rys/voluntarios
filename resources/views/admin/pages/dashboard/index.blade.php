@extends('admin.templates.template')
{{-- @include('admin.partials.datatable') --}}
@section('styles_cdn')
    <style>
        canvas{

        width:1000px !important;
        /* height:600px !important; */

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
    <section class="content" style="margin: 50px auto;">
        <h1 class="text-center">Título</h1>
        <div class="dashboard-container">
            @foreach (config('app_voluntarios.modos_graficos') as $tipo_grafico)
                @foreach (config('app_voluntarios.graficos')  as $item)
                    <div class="card-1">
                        <h4 class="chart-lbl">
                            {{ $item->titulo }}
                        </h4>
                        <div class="divider">
                        </div>
                        <div class="content-center">
                            <div class="{{ $tipo_grafico->class_parent }}">
                                <canvas class="{{ $tipo_grafico->class_canvas }}" id="{{ $item->id }}-{{ $tipo_grafico->nombre }}">
                                </canvas>
                            </div>
                        </div>
                    </div>
                @endforeach
            @endforeach

            {{-- <div class="card-7">
                <h4 class="chart-lbl">
                    Mixed Chart
                </h4>
                <div class="divider">
                </div>
                <div class="mixed-chart-container">
                    <canvas class="mixed-chart" id="mixed">
                    </canvas>
                </div>
            </div> --}}
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
